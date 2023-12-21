<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthorizationController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return redirect()->route('dashboard');
// });

// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

// -- VIEW AUTHORIZATION PAGES --
// Route::get('/login', [AuthorizationController::class, 'login'])->name('login');
Route::get('/login', [AuthorizationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthorizationController::class, 'login']);
Route::post('/logout', [AuthorizationController::class, 'logout'])->name('logout');

Route::get('/register', [AuthorizationController::class, 'register'])->name('register');
Route::get('/dashboard-admin', [AuthorizationController::class, 'dashboard_admin'])->name('dashboard_admin');



Route::get('/forgot-password', [AuthorizationController::class, 'forgotpassword'])->name('forgotpassword');

Route::get('/reset-password', [AuthorizationController::class, 'resetpassword'])->name('resetpassword');

// -- VIEW PAGES --
Route::middleware(['auth'])->group(function () {
    // -- VIEW PAGES --
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/project-list', [PageController::class, 'project_list'])->name('project_list');
    Route::get('/schedule-view', [PageController::class, 'schedule_view'])->name('schedule_view');
    Route::get('/project-draft', [PageController::class, 'project_draft'])->name('project_draft');
    Route::get('/project-complete', [PageController::class, 'project_complete'])->name('project_complete');
    Route::get('/project-detail/{projNum}', [PageController::class, 'project_detail'])->name('project_detail');
    Route::get('/project-dropped', [PageController::class, 'project_dropped'])->name('project_dropped');
    Route::get('/add-new-project', [PageController::class, 'add_new_project'])->name('add_new_project');
    Route::get('/calendar', [PageController::class, 'calendar'])->name('calendar');
    Route::get('/wip-external', [PageController::class, 'wip_external'])->name('wip_external');
    Route::get('/wip-internal', [PageController::class, 'wip_internal'])->name('wip_internal');
    // ... (other protected routes)

    // -- FUNCTIONS --
    // ... (other protected routes requiring authentication)
});

// -- FUNCTIONS --
// Add New Project router
Route::get('/get-members/{roleId}', 'App\Http\Controllers\ProjectController@getMembersByRole');
Route::post('/store-project', [ProjectController::class, 'store'])->name('projects.store');
Route::post('/store-activities', [ProjectController::class, 'storeActivity'])->name('post_activities');

// Project Detail router
Route::post('/upload-images', [ProjectController::class, 'uploadImages'])->name('upload_images');
Route::post('/update-project', [ProjectController::class, 'updateProject'])->name('update_project');
Route::post('/update-actual-date', [ProjectController::class, 'updateActualDate'])->name('update_actual_date');
Route::post('/log-changes', [ProjectController::class, 'logChanges'])->name('log_changes');
Route::post('/activity-actualized', [ProjectController::class, 'activityActualized'])->name('activity_actualized');
Route::post('/add-delay-reason', [ProjectController::class, 'addDelayReason'])->name('add_delay_reason');
Route::post('/delete-image', [ProjectController::class, 'deleteImage'])->name('delete_image');
Route::post('/drop-project', [ProjectController::class, 'dropProject'])->name('drop_project');

// Project Drop router
Route::post('/prelim-project', [ProjectController::class, 'prelimProject'])->name('prelim_project');

// Project Lists router
Route::get('/get-all-projects', [ProjectController::class, 'getAllProjects'])->name('getAllProjects');

// Project Draft router
Route::post('/delete-project', [ProjectController::class, 'deleteProject'])->name('delete_project');

// Schedule View router
Route::post('/update_cosi', [ProjectController::class, 'postCosI'])->name('update_cosi');
Route::post('/storeLACommit', [ProjectController::class, 'storeLACommit'])->name('storeLACommit');

// WIP Meeting router
Route::post('/get-prodnum', [ProjectController::class, 'getProdNumbersForCategory'])->name('get_prodnum');
Route::get('/get-wip', [ProjectController::class, 'getWIPData'])->name('get_wip');
Route::get('/get-member', [ProjectController::class, 'getAssignedMembers'])->name('get_member');
Route::post('/add-key-update', [ProjectController::class, 'addKeyUpdate'])->name('add_key_update');
Route::get('/getKeyUpdateData', [ProjectController::class, 'getKeyUpdateData'])->name('getKeyUpdateData');
Route::post('/updateKeyUpdateData', [ProjectController::class, 'updateKeyUpdateData'])->name('updateKeyUpdateData');
Route::post('/deleteKeyUpdate', [ProjectController::class, 'deleteKeyUpdate'])->name('deleteKeyUpdate');
Route::get('/getToyPhotoPresent', [ProjectController::class, 'getToyPhotoPresent'])->name('getToyPhotoPresent');
Route::post('/update-cost', [ProjectController::class, 'updateCost'])->name('updateCost');

// WM router
Route::get('/getWIPExtData', [ProjectController::class, 'getWIPExtData'])->name('getWIPExtData');

// Register Account router
Route::post('/register-account', [AuthorizationController::class, 'registerAccount'])->name('registerAccount');

// Authorization Page router
Route::get('/get-user/{userID}', [AuthorizationController::class, 'getUserData'])->name('get-user');
Route::post('/update-user/{userID}', [AuthorizationController::class, 'updateUser']);
Route::delete('/delete-user/{userID}', [AuthorizationController::class, 'deleteUser']);


