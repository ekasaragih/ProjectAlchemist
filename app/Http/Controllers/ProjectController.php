<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use App\Models\AssignedMember;
use App\Models\Project;
use App\Models\Users;
use App\Models\UserGroup;
use App\Models\Activity;
use App\Models\ActivityLog;
use App\Models\DelayReason;
use App\Models\Image;
use App\Models\KeyUpdates;

class ProjectController extends Controller
{
    // Add New Project Controllers start
    public function getMembersByRole($roleID)
    {
        $users = Users::where('grp_ID', $roleID)->select('us_ID', 'us_name')->get();
    
        return response()->json($users);
    }     

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'ProjectNumber' => 'required',
            'ProdDesc' => 'required',
            'Categories' => 'required',
            'Type' => 'nullable',
            'ProdNum' => 'required',
            'Cmplx' => 'nullable',
            'AgeGrd' => 'nullable',
            'Quota' => 'nullable|numeric',
            'LQ' => 'nullable|numeric',
            'LA' => 'nullable|date',
            'Season' => 'required',
            'Retail' => 'nullable|numeric',
            'TargetCost' => 'nullable|numeric',
            'ToolBdg' => 'nullable|numeric',
            'Licensed' => 'nullable|boolean',
            'CRFPR' => 'nullable|boolean',
            'Note' => 'nullable',
        ]);
        
        $fixedSections = json_decode($request->input('fixedSections'));
        if ($fixedSections && is_array($fixedSections)) {
            foreach ($fixedSections as $section) {
                AssignedMember::create([
                    'p_projnum' => $validatedData['ProjectNumber'],
                    'role_name' => isset($section->role) ? $section->role : null,
                    'us_ID' => isset($section->memberId) ? $section->memberId : null,
                ]);
            }
        }

        // Process removed sections data
        $removedSections = json_decode($request->input('removedSections'));
        if ($removedSections && is_array($removedSections)) {
            foreach ($removedSections as $section) {
                AssignedMember::create([
                    'p_projnum' => $validatedData['ProjectNumber'],
                    'role_name' => isset($section->role) ? $section->role : null,
                    'us_ID' => isset($section->memberId) ? $section->memberId : null,
                ]);
            }
        }

        $status = $request->input('status');

        // Create a new Project instance and fill it with the validated data
        $project = new Project();
        $project->p_projnum = $validatedData['ProjectNumber'];
        $project->p_desc = $validatedData['ProdDesc'];
        $project->p_categories = $validatedData['Categories'];
        $project->p_type = $validatedData['Type'];
        $project->p_prodnum = $validatedData['ProdNum'];
        $project->p_complx = $validatedData['Cmplx'];
        $project->p_agegrd = $validatedData['AgeGrd'];
        $project->p_quota = $validatedData['Quota'];
        $project->p_lq = $validatedData['LQ'];
        $project->p_la = $validatedData['LA'];
        $project->p_season = $validatedData['Season'];
        $project->p_retail = $validatedData['Retail'];
        $project->p_tgtcost = $validatedData['TargetCost'];
        $project->p_toolbdg = $validatedData['ToolBdg'];
        $project->p_licen = $validatedData['Licensed'] ?? 0;
        $project->p_crfpr = $validatedData['CRFPR'] ?? 0;
        $project->p_notes = $validatedData['Note'];
        $project->p_stat = $status === 'Preliminary' ? 'Preliminary' : 'Draft';

        // Save the project to the database
        $project->save();

        // Return a response (you can customize this based on your needs)
        return redirect()->route('project_list')->with('success', 'Project saved successfully');
    }

    public function storeActivity(Request $request)
    {
        // Validate incoming request data if necessary
        $validatedData = $request->validate([
            'activities.*.p_projnum' => 'required|string',
            'activities.*.a_name' => 'required|string',
            'activities.*.a_sch' => 'required|date',
        ]);
    
        try {
            // Loop through each activity and save it
            foreach ($validatedData['activities'] as $activityData) {
                // Create a new Activity instance for each activity
                $activity = new Activity();
    
                // Assign values from the request to the Activity model attributes
                $activity->p_projnum = $activityData['p_projnum'];
                $activity->a_name = $activityData['a_name'];
                $activity->a_sch = $activityData['a_sch'];
    
                // Save the activity to the database
                $activity->save();
            }
    
            return response()->json(['message' => 'Data saved successfully']);
        } catch (\Exception $e) {
            // Handle any exceptions or errors that might occur during the save process
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }    

    public function uploadImages(Request $request)
    {
        try {
            $projectNumber = $request->input('projectNumber');
            $images = $request->file('files');
            $imageUrls = [];

            foreach ($images as $image) {
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

                // Save image to the server
                $image->move(public_path('uploads/scheduler-img'), $fileName);

                // Save image details to the database
                $newImage = new Image();
                $newImage->i_photoname = $fileName;
                $newImage->p_projnum = $projectNumber;

                $userId = Auth::id();
                $newImage->i_uploadedby = $userId;

                $newImage->save();

                // Add the image URL to the list
                $imageUrl = asset('uploads/scheduler-img/' . $fileName);
                $imageUrls[] = $imageUrl;
            }

            return response()->json(['success' => true, 'message' => 'Images uploaded successfully', 'imageUrls' => $imageUrls]);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Image upload failed: ' . $ex->getMessage()]);
        }
    }
    // Add New Project Controllers end

    // Project Lists Controllers start
    public function getAllProjects()
    {
        $projects = Project::select(
                'project.p_projnum as ProjectNumber',
                'project.p_prodnum as ProdNum',
                'project.p_desc as ProdDesc',
                'project.p_categories as Categories',
                'project.created_at as CreatedAt',
                'project.p_stat as Status',
                'user.us_name as ProductEngineer',
                'activity_fpr.a_act as FPRActualDate',
                'activity_fpr.a_sch as FPRScheduleDate',
                'activity_dsp.a_act as DSPActualDate',
                'activity_dsp.a_sch as DSPScheduleDate'
            )
            ->leftJoin('assigned', 'project.p_projnum', '=', 'assigned.p_projnum')
            ->leftJoin('user', 'assigned.us_ID', '=', 'user.us_ID')
            ->where('assigned.role_name', '=', 'Product Engineer')
            ->leftJoin('activity as activity_fpr', function($join) {
                $join->on('project.p_projnum', '=', 'activity_fpr.p_projnum')
                     ->where('activity_fpr.a_name', '=', 'FPR Meeting');
            })
            ->leftJoin('activity as activity_dsp', function($join) {
                $join->on('project.p_projnum', '=', 'activity_dsp.p_projnum')
                     ->where('activity_dsp.a_name', '=', 'DSP Finish (Control Drawing & Artwork Complete)');
            })
            ->get();
    
        foreach ($projects as $project) {
            $project->FPRMeetDate = $project->FPRActualDate ? $project->FPRActualDate : $project->FPRScheduleDate;
            $project->DSPFDate = $project->DSPActualDate ? $project->DSPActualDate : $project->DSPScheduleDate;
        }
        
        return response()->json($projects);
    }
    // Project Lists Controllers end
    
    // Project Detail Controllers start
    public function updateProject(Request $request)
    {
        $updatedProject = $request->all();

        try {
            // Fetch the corresponding project from the database based on the project number.
            $existingProject = Project::where('p_projnum', $updatedProject['ProjectNumber'])->first();

            if ($existingProject) {
                $existingProject->p_type = $updatedProject['Type'];
                $existingProject->p_prodnum = $updatedProject['ProdNum'];
                $existingProject->p_complx = $updatedProject['Cmplx'];
                $existingProject->p_desc = $updatedProject['ProdDesc'];
                $existingProject->p_agegrd = $updatedProject['AgeGrd'];
                $existingProject->p_quota = $updatedProject['Quota'];
                $existingProject->p_lq = $updatedProject['LQ'];
                $existingProject->p_la = $updatedProject['LA'];
                $existingProject->p_season = $updatedProject['Season'];
                $existingProject->p_retail = $updatedProject['Retail'];
                $existingProject->p_tgtcost = $updatedProject['TgtCost'];
                $existingProject->p_toolbdg = $updatedProject['ToolBdg'];
                $existingProject->p_notes = $updatedProject['Note'];

                // Save changes to the database.
                $existingProject->save();

                return response()->json(['success' => true, 'message' => 'Project updated successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Project not found in the database']);
            }
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Project update failed: ' . $ex->getMessage()]);
        }
    }

    public function updateActualDate(Request $request)
    {
        $requestData = $request->all();

        try {
            // Fetch the activity based on its name and project number
            $activity = Activity::where('a_name', $requestData['activityName'])
                ->where('p_projnum', $requestData['projectNumber'])
                ->first();

            if ($activity) {
                // Update the actual date
                $activity->a_act = $requestData['actualizedDate'];
                $activity->save();

                $this->updateStatus($requestData['projectNumber']);
                return response()->json(['success' => true, 'message' => 'Actual date updated successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Activity not found for the given project']);
            }

            
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Actual date update failed: ' . $ex->getMessage()]);
        }
    }

    private function updateStatus($projNum)
    {
        $project = Project::where('p_projnum', $projNum)->first();

        if (!$project) {
            // Handle project not found
            return;
        }

        $activities = Activity::where('p_projnum', $projNum)->get();

        $hasActual = function ($activityName) use ($activities) {
            return $activities->where('a_name', $activityName)->whereNotNull('a_act')->isNotEmpty();
        };

        $hasActualAndActualized = function ($activityName) use ($activities) {
            return $activities->where('a_name', $activityName)
                ->whereNotNull('a_act')
                ->where('a_actlzd', 'A')
                ->isNotEmpty();
        };

        if ($hasActual('BOM Input')) {
            $project->p_stat = "1st Cost CR";
        } else if ($hasActual('CR Model Ready') && $hasActualAndActualized('CR Cost Done')) {
            $project->p_stat = "Prep CR Model";
        } else if ($hasActual('CR Meeting') && $hasActualAndActualized('CR Model Ready')) {
            $project->p_stat = "CR Approval";
        } else if ($hasActual('FPR Cost Done') && $hasActualAndActualized('CR Meeting')) {
            $project->p_stat = "FPR Cost";
        } else if ($hasActual('FPR Model Ready') && $hasActualAndActualized('FPR Cost Done')) {
            $project->p_stat = "Prep FPR Model";
        } else if ($hasActual('FPR Meeting') && $hasActualAndActualized('FPR Model Ready')) {
            $project->p_stat = "FPR Approval";
        } else if ($hasActualAndActualized('FPR Meeting')) {
            $project->p_stat = "Done";
        }
        
        $project->save();
        
    }

    public function logChanges(Request $request)
    {
        $projNum = $request->input('projNum');
        $after = $request->input('after');
        $field = $request->input('field');
        // $actName = $request->input('actName');
    
        // Retrieve the 'before' value from the activity table
        $before = Activity::where('a_name', $field)
                          ->where('p_projnum', $projNum)
                          ->value('a_act');
    
        $logEntry = new ActivityLog();
        $logEntry->p_projnum = $projNum;
        $logEntry->l_field = $field;
        $logEntry->l_before = $before;
        $logEntry->l_after = $after;
        // $logEntry->change_by = session('us_KPK'); // Assuming 'us_KPK' is stored in the session
    
        $logEntry->save();
    
        return response()->json(['success' => true]);
    }
    
    public function activityActualized(Request $request)
    {
        $activityName = $request->input('activityName');
        $projectNumber = $request->input('projectNumber');

        // Retrieve the activity record
        $activity = Activity::where('a_name', $activityName)
                            ->where('p_projnum', $projectNumber)
                            ->first();

        if ($activity) {
            if ($activity->a_act !== null) {
                $activity->a_actlzd = 'A'; // Actualize the activity
                $activity->save();
                return response()->json(['success' => true]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Please input the actual date first!'
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Activity or project not found.'
        ]);
    }
    
    public function addDelayReason(Request $request)
    {
        try {
            $projNum = $request->input('projnum');
            $activityName = $request->input('activityName');
            $delayDesc = $request->input('delayDesc');

            // Find the activity based on the project number and activity name
            $activity = Activity::where('p_projnum', $projNum)
                                ->where('a_name', $activityName)
                                ->first();

            if ($activity) {
                // Create a new delay entry and save it to the database
                $delay = new DelayReason();
                $delay->rd_delaytype = 'Activity';
                $delay->p_projnum = $projNum;
                $delay->a_ID = $activity->a_ID;
                $delay->rd_delaydesc = $delayDesc;
                $delay->save();

                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Activity not found.']);
            }
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'error' => $ex->getMessage()]);
        }
    }

    public function deleteImage(Request $request)
    {
        try {
            $photoName = $request->input('photoName');
    
            // Extract the file name from the URL
            $fileName = basename($photoName);
    
            // Find the image by its name in the database
            $picture = Image::where('i_photoname', $fileName)->first();
    
            if (!$picture) {
                // Image not found in the database
                return response()->json(['success' => false, 'message' => 'Image not found in the database.']);
            }
    
            // Delete the image record from the database
            $picture->delete();
    
            // Delete the image file from the server
            $filePath = public_path('uploads/scheduler-img/') . $fileName;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
    
            return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Image deletion failed: ' . $ex->getMessage()]);
        }
    }
    
    public function dropProject(Request $request)
    {
        try {
            $projectNumber = $request->input('projectNumber');

            // Find the project by its number in the database
            $project = Project::where('p_projnum', $projectNumber)->first();

            if (!$project) {
                // Project not found in the database
                return response()->json(['success' => false, 'message' => 'Project not found.']);
            }

            // Update the project status to "Drop"
            $project->p_stat = 'Drop'; // Adjust as needed based on your status naming convention
            $project->save();

            return response()->json(['success' => true, 'message' => 'Project status updated successfully.']);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Error updating project status: ' . $ex->getMessage()]);
        }
    }
    // Project Detail Controllers end

    // Schedule View Controllers start
    public function postCosI(Request $request)
    {
        $projNum = $request->input('projNum');
        $cosiValue = $request->input('cosiValue');

        $project = Project::where('p_projnum', $projNum)->first();

        if (!$project) {
            return response()->json(['message' => 'Project not found.'], 404);
        }

        $project->p_cosi = $cosiValue;
        $project->updated_at = now(); // Or use the appropriate updated_at value

        $project->save();

        return response()->json(['message' => 'p_cosi updated successfully.']);
    }

    public function storeLACommit(Request $request)
    {
        // Retrieve the posted data
        $p_projnum = $request->input('p_projnum');
        $a_name = $request->input('a_name');
        $a_act = $request->input('a_act');

        // Store the received data in the activity table or perform other actions
        // Example:
        Activity::create([
            'p_projnum' => $p_projnum,
            'a_name' => $a_name,
            'a_act' => $a_act
        ]);

        // Return a success response if needed
        return response()->json(['message' => 'Activity stored successfully']);
    }
    // Schedule View Controllers end

    // Project Drop Controllers start
    public function prelimProject(Request $request)
    {
        try {
            $projNum = $request->input('projNum');
    
            $project = Project::where('p_projnum', $projNum)->first();
    
            if (!$project) {
                // Project not found
                return response()->json(['success' => false, 'message' => 'Project not found.']);
            }
    
            // Update the project status to 'Preliminary'
            $project->p_stat = 'Preliminary';
    
            // Save the updated status
            $project->save();
    
            return response()->json(['success' => true, 'message' => 'Project status updated to Preliminary.']);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Error updating project status: ' . $ex->getMessage()]);
        }
    }
    // Project Drop Controllers end

    // Project Draft Controllers start
    public function deleteProject(Request $request)
    {
        try {
            $projectId = $request->input('projectId');
    
            // Find the project by its ID
            $project = Project::where('p_projnum', $projectId)->first();
    
            if (!$project) {
                return response()->json(['success' => false, 'message' => 'Project not found.']);
            }
    
            // Delete related members
            AssignedMember::where('p_projnum', $projectId)->delete();
    
            // Delete related activities
            Activity::where('p_projnum', $projectId)->delete();
    
            // Now delete the project itself
            $project->delete();
    
            return response()->json(['success' => true, 'message' => 'Project and related records deleted successfully.']);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Error deleting project: ' . $ex->getMessage()]);
        }
    }
    // Project Draft Controllers end

    // WIP Meeting Controllers start
    public function getProdNumbersForCategory(Request $request)
    {
        $selectedCategory = $request->input('selectedCategory');

        $categorizedBrands = [
            'Upper Body Clothing' => ['Shirt', 'Jacket', 'Sweater', 'Jersey', 'T-Shirt', 'Dress'],
            'Undergarments' => ['Underwear', 'Socks', 'Hosiery'],
            'Lower Body Clothing' => ['Dress', 'Skirt', 'Pants', 'Legging/Tight'],
            'Swimwear' => ['Swimsuit'],
        ];

        if (array_key_exists($selectedCategory, $categorizedBrands)) {
            $selectedBrands = $categorizedBrands[$selectedCategory];

            // Query the database to retrieve toy numbers based on the selected brands
            $toyNumbers = Project::where('p_stat', '!=', 'Draft')
                ->whereIn('p_categories', $selectedBrands)
                ->pluck('p_prodnum')
                ->toArray();

            return response()->json($toyNumbers);
        }

        return response()->json([]);
    }

    public function getWIPData(Request $request)
    {
        $prodNum = $request->input('prodNum');
    
        // Fetch project data
        $project = Project::where('p_prodnum', $prodNum)
            ->where('p_stat', '!=', 'Draft')
            ->first();

            $schedule = [];
            $keyUpdatesData = [];

            if ($project) {
                    $activities = Activity::where('p_projnum', $project->p_projnum)->get();

                    // Find specific activities by name and get their corresponding dates
                    $dspf = $activities->where('a_name', 'DSP Finish (Control Drawing & Artwork Complete)')->first();
                    $costext = $activities->where('a_name', '1st Cost External')->first();
                    $crcostdone = $activities->where('a_name', 'CR Cost Done')->first();
                    $crmeet = $activities->where('a_name', 'CR Meeting')->first();
                    $fprmeet = $activities->where('a_name', 'FPR Meeting')->first();

                    // Extract the dates if activities exist
                    $dspfDate = $dspf ? $dspf->a_sch : null;
                    $costextDate = $costext ? $costext->a_act : null;
                    $crcostdoneDate = $crcostdone ? $crcostdone->a_act : null;
                    $crmeetDate = $crmeet ? $crmeet->a_act : null;
                    $fprmeetDate = $fprmeet ? $fprmeet->a_act : null;

                    $schedule = [
                        'DSP Finish (Control Drawing & Artwork Complete)' => $dspfDate,
                        '1st Cost External' => $costextDate,
                        'CR Cost Done' => $crcostdoneDate,
                        'CR Meeting' => $crmeetDate,
                        'FPR Meeting' => $fprmeetDate,
                    ];

                    // Fetch key updates data
                    $keyUpdatesData = KeyUpdates::where('p_projnum', $project->p_projnum)
                    ->select('ku_keyupdate', 'ku_keydate')
                    ->get()
                    ->toArray();
                }
        
            return response()->json([
                'projectData' => $project,
                'scheduleData' => $schedule,
                'keyUpdatesData' => $keyUpdatesData
            ]);
    }
    
    public function getAssignedMembers(Request $request)
    {
        $projectNumber = $request->input('projectNumber');

        // Fetch assigned members based on project number
        $assignedMembers = AssignedMember::with('user')
            ->where('p_projnum', $projectNumber)
            ->get();

        return response()->json($assignedMembers);
    }

    public function addKeyUpdate(Request $request)
    {
        try {
            // Convert 'shownAt' value based on the checkbox state
            $shownAt = $request->input('shownAt') === '1' ? 'WIP External' : 'WIP Internal';

            // Create a new KeyUpdates instance and set its properties
            $keyUpdate = new KeyUpdates([
                'ku_keyupdate' => $request->input('keyUpdates'),
                'ku_keydate' => $request->input('keyDate'),
                'p_projnum' => $request->input('projnum'),
                'shown_at' => $shownAt
            ]);

            // Save the new key update to the database
            $keyUpdate->save();

            return response()->json(['success' => true, 'message' => 'Key update added successfully']);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $ex->getMessage()]);
        }
    }

    public function getKeyUpdateData(Request $request)
    {
        $projectNumber = $request->input('projectNumber');
        $keyUpdate = $request->input('keyUpdate');

        try {
            $keyUpdateData = KeyUpdates::where('p_projnum', $projectNumber)
                ->where('ku_keyupdate', $keyUpdate)
                ->first();

            if ($keyUpdateData) {
                return response()->json($keyUpdateData);
            }

            return response()->json(['error' => 'Key update not found'], 404);
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            // \Log::error('Error: ' . $ex->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function updateKeyUpdateData(Request $request)
    {
        try {
            // Retrieve the key update record to update
            $keyUpdate = KeyUpdates::where('p_projnum', $request->projectNumber)->first();

            if ($keyUpdate) {
                // Update the key update data
                $keyUpdate->ku_keyupdate = $request->updatedKey;
                $keyUpdate->ku_keydate = $request->updatedDate;
                $keyUpdate->shown_at = $request->updatedShownAt;
                $keyUpdate->updated_at = now();

                // Save the changes to the database
                $keyUpdate->save();

                return response()->json(['success' => true]);
            }

            return response()->json(['error' => 'Key update not found']);
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            // \Log::error("Error: " . $ex->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function deleteKeyUpdate(Request $request)
    {
        try {
            $projectNumber = $request->input('projectNumber');
            $keyUpdate = $request->input('keyUpdate');

            // Find the key update record based on projectNumber and key updates description
            $keyUpdateRecord = KeyUpdates::where('p_projnum', $projectNumber)
                ->where('ku_keyupdate', $keyUpdate)
                ->first();

            if ($keyUpdateRecord) {
                // Delete the key update record
                $keyUpdateRecord->delete();

                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false, 'message' => 'Key update not found']);
        } catch (\Exception $ex) {
            // \Log::error("Error: " . $ex->getMessage());
            return response()->json(['success' => false, 'error' => 'Internal Server Error'], 500);
        }
    }

    public function getToyPhotoPresent(Request $request)
    {
        $projectNumber = $request->input('projectNumber');

        // Fetch image URLs associated with the project number using the Image model
        $imageUrls = Image::where('p_projnum', $projectNumber)
            ->pluck('i_photoname')
            ->toArray();

        return response()->json(['imageUrls' => $imageUrls]);
    }

    public function updateCost(Request $request)
    {
        $projectNumber = $request->input('projectNumber');
        $cost = $request->input('cost');

        $project = Project::where('p_projnum', $projectNumber)->first();

        if ($project) {
            $project->p_crncost = $cost;
            $project->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    // WIP Meeting Controllers end

    // WM Controllers start
    public function getWIPExtData(Request $request)
    {
        $keydate = $request->input('keydate');
    
        $projects = Project::whereHas('keyUpdates', function ($query) use ($keydate) {
            $query->where('ku_keydate', $keydate)
                ->where('shown_at', 'WIP External');
        })->with(['assigned', 'activity'])
            ->get();
    
        // Fetch the member names for Product Engineers
        $productEngineers = [];
        foreach ($projects as $project) {
            $productEngineer = $project->assigned->firstWhere('role_name', 'Product Engineer');
            if ($productEngineer) {
                $user = Users::find($productEngineer->us_ID);
                $productEngineers[$project->p_projnum] = $user ? $user->us_name : '';
            } else {
                $productEngineers[$project->p_projnum] = '';
            }
        }
    
        // Append the member names to each project object
        foreach ($projects as $project) {
            $project->productEngineerName = $productEngineers[$project->p_projnum];
        }
    
        return response()->json([
            'projects' => $projects,
            'keyUpdates' => KeyUpdates::where('ku_keydate', $keydate)
                                      ->where('shown_at', 'WIP External')
                                      ->get()
        ]);
    }
    // WM Controllers end
}
