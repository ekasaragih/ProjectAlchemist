<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user's name from the session
        $authenticatedUserName = session('authenticatedUserName');

        if (Auth::check() && $authenticatedUserName) {
            // Get counts of projects based on different statuses
            $totalProjects = Project::count();
            $projectsInProgress = Project::whereNotIn('p_stat', ['Draft', 'Done', 'Drop'])->count();
            $projectsDraft = Project::where('p_stat', 'Draft')->count();
            $projectsCompleted = Project::where('p_stat', 'Done')->count();
            $projectsDrop = Project::where('p_stat', 'Drop')->count();

            $upperBodyClothingCount = $this->getCategoryCount(['Shirt', 'Jacket', 'Sweater', 'Jersey', 'T-Shirt', 'Dress']);
            $lowerBodyClothingCount = $this->getCategoryCount(['Skirt', 'Pants', 'Legging/Tight']);
            $undergarmentsCount = $this->getCategoryCount(['Underwear', 'Socks', 'Hosiery']);
            $swimwearCount = $this->getCategoryCount(['Swimsuit']);

            $percentComplete = number_format(($projectsCompleted / $totalProjects) * 100, 2);
            $percentOnGoing = number_format((($totalProjects - ($projectsDraft + $projectsDrop + $projectsCompleted)) / $totalProjects) * 100, 2);
            $percentDraft = number_format(($projectsDraft / $totalProjects) * 100, 2);
            $percentDrop = number_format(($projectsDrop / $totalProjects) * 100, 2);            

            return view('pages.dashboard', [
                'userName' => $authenticatedUserName,
                'totalProjects' => $totalProjects,
                'projectsInProgress' => $projectsInProgress,
                'projectsDraft' => $projectsDraft,
                'projectsCompleted' => $projectsCompleted,
                'upperBodyClothingCount' => $upperBodyClothingCount,
                'lowerBodyClothingCount' => $lowerBodyClothingCount,
                'undergarmentsCount' => $undergarmentsCount,
                'swimwearCount' => $swimwearCount,
                'percentComplete' => $percentComplete,
                'percentOnGoing' => $percentOnGoing,
                'percentDraft' => $percentDraft,
                'percentDrop' => $percentDrop
            ]);
        }
        
        // If not authenticated or the user's name is not available, redirect to login with an error message
        return redirect()->route('login')->with('error', 'Please log in to access the dashboard.');
    }

    private function getCategoryCount($categories)
    {
        return Project::whereIn('p_categories', $categories)->count();
    }
}
