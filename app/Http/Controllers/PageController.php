<?php

namespace App\Http\Controllers;

use App\Models\AssignedMember;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Project;
use App\Models\Users;
use App\Models\UserGroup;
use App\Models\Activity;
use App\Models\DelayReason;
use App\Models\Image;
use App\Models\KeyUpdates;

class PageController extends Controller
{
    public function index($page)
    {
        if (view()->exists("pages.{$page}")) {
            $userName = session('authenticatedUserName'); // Fetch the authenticated user's name from the session
            return view("pages.{$page}", compact('userName')); // Pass it to the view
        }

        return abort(404);
    }

    public function project_list()
    {
        return view("pages.project-list");
    }

    public function project_complete()
    {
        return view("pages.project-complete");
    }

    public function schedule_view()
    {
        $projects = Project::orderByDesc('created_at')
            ->select([
                'p_projnum as ProjectNumber',
                'p_prodnum as ProdNum',
                'p_desc as Desc',
                'p_categories as Categories',
                'p_la as LA',
                'p_stat as Status',
                'p_cosi as CostIteration'
            ])
            ->where('p_stat', '!=', 'draft')
            ->get();
    
        foreach ($projects as $project) {
            $productEngineer = AssignedMember::where('p_projnum', $project->ProjectNumber)
                ->where('role_name', 'Product Engineer')
                ->first();
    
            if ($productEngineer) {
                $user = Users::find($productEngineer->us_ID);
    
                if ($user) {
                    $productName = $user->us_name;
                    $project->ProductEngineer = $productName;
                }
            }
    
            $activities = Activity::where('p_projnum', $project->ProjectNumber)->get();
    
            foreach ($activities as $activity) {
                $project->{$activity->a_name . '_sch'} = $activity->a_sch;
                $project->{$activity->a_name . '_act'} = $activity->a_act;
            
                $actualizedActivity = Activity::where('p_projnum', $project->ProjectNumber)
                    ->where('a_name', $activity->a_name)
                    ->where('a_actlzd', 'A')
                    ->value('a_actlzd');
            
                $project->{$activity->a_name . '_actlzd'} = $actualizedActivity ?: '';
            }
            
        }
    
        return view("pages.schedule-view", ['projects' => $projects]);
    }    
    
    public function project_draft()
    {
        return view("pages.project-draft");
    }

    public function project_detail($projNum)
    {
        // Fetch project details based on $projNum
        $project = Project::with(['assigned' => function ($query) {
            $query->join('user', 'assigned.us_ID', '=', 'user.us_ID')
                ->select('assigned.p_projnum', 'assigned.role_name', 'assigned.us_ID', 'user.us_name as user_name');
        }])->where('p_projnum', $projNum)->first();

        $activity = Activity::where('p_projnum', $projNum)->get();

        // Fetch delay reasons for each activity
        foreach ($activity as $act) {
            $delayReason = DelayReason::where('p_projnum', $projNum)
                ->where('a_ID', $act->a_ID)
                ->value('rd_delaydesc');

            $act->ReasonForDelay = $delayReason;
        }

         // Fetch image URLs associated with the project
        $imageUrls = Image::where('p_projnum', $projNum)->pluck('i_photoname')->toArray();
        $imageUrls = array_map(function ($imageName) {
            return asset('uploads/scheduler-img/' . $imageName);
        }, $imageUrls);

        if (!$project) {
            // Handle case where project is not found, maybe return a 404 or redirect
            return redirect()->route('some.route'); // Adjust this to fit your app logic
        }

        // Other data fetching logic goes here...

        return view("pages.project-detail", [
            'project' => $project,
            'activity' => $activity,
            'imageUrls' => $imageUrls,
        ]);
    }

    public function project_dropped()
    {
        return view("pages.project-dropped");
    }

    public function add_new_project()
    {
        return view("pages.add-new-project");
    }

    public function calendar()
    {
        return view("pages.calendar");
    }

    public function wip_external()
    {
        $keyDates = KeyUpdates::where('shown_at', 'WIP External')
            ->distinct()
            ->pluck('ku_keydate')
            ->map(function ($date) {
                return Carbon::parse($date)->toDateString();
            });
    
        return view("pages.wip-external", ['keyDates' => $keyDates]);
    }     

    public function wip_internal()
    {
        return view("pages.wip-internal");
    }
}
