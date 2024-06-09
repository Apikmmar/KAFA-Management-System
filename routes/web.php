<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

// Route for all user
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::put('/profile/{id}', [AccountController::class, 'updateProfile'])->name('profile.update');
});

// Route for MUIP Admin
Route::group(['middleware' => 'role:1'], function () {

});

// Route for KAFA-Admin
Route::group(['middleware' => 'role:2'], function () {
    // Manage Account
    Route::get('/registerteacher', [AccountController::class, 'registerteacher'])->name('registerteacher');
    Route::post('/registerteacher', [AccountController::class, 'createteacher'])->name('registerteacher.create');

    // Manage Schedule
    Route::get('/all_class', [ScheduleController::class, 'allclass'])->name('allclass');
    Route::get('/add_classroom', [ScheduleController::class, 'addclassroom'])->name('addclassroom');
    Route::post('/add_classroom', [ScheduleController::class, 'createClassroom'])->name('addclassroom.create');
    Route::get('/view_classroom/{id}', [ScheduleController::class, 'viewclassroom'])->name('viewclassroom');

    //Manage Result
    Route::get('/add_session', [ResultController::class, 'addSession'])->name('addsession');
    Route::post('/add_session', [ResultController::class, 'storeSession'])->name('storeSession');
    Route::delete('/add_session/{id}', [ResultController::class, 'deletesession'])->name('deletesession');
    Route::get('/result_approval_list', [ResultController::class, 'resultapprovallist'])->name('resultapprovallist');


    Route::get('/studentlistreview/{result_id}', [ResultController::class, 'studentListReview'])->name('studentlistreview');
    // Route to handle result approval/rejection
    Route::post('/updateapproval', [ResultController::class, 'updateApproval'])->name('updateapproval');
    Route::post('/deleteapproval', [ResultController::class, 'deleteapproval'])->name('deleteapproval');

});

// Route for Parent
Route::group(['middleware' => 'role:3'], function () {
    // Manafe Account
    Route::get('/registerchild', [AccountController::class, 'registerchild'])->name('registerchild');
    Route::post('/registerchild', [AccountController::class, 'createchild'])->name('registerchild.create');

    // Manage Schedule
    Route::get('/child_kafa', [ScheduleController::class, 'childkafa'])->name('childkafa');
    Route::get('/kafa_schedule/{id}', [ScheduleController::class, 'kafaschedule'])->name('kafaschedule');

    //Manage Result
    Route::get('/select_result_info', [ResultController::class, 'selectresultinfo'])->name('selectresultinfo');
    Route::get('/resultslip', [ResultController::class, 'resultslip'])->name('resultslip');
});

// Route for Teacher
Route::group(['middleware' => 'role:4'], function () {
    // Manage Schedule
    Route::get('/class_activity', [ScheduleController::class, 'classactivity'])->name('classactivity');
    Route::get('/new_activity', [ScheduleController::class, 'newactivity'])->name('newactivity');
    Route::post('/new_activity', [ScheduleController::class, 'createClassActivity'])->name('newactivity.create');
    Route::get('/activity_details/{id}', [ScheduleController::class, 'activitydetails'])->name('activitydetails');
    Route::put('/activity_details/{id}', [ScheduleController::class, 'UpdateClassactivity'])->name('activitydetails.update');
    Route::delete('/activity_details/{id}', [ScheduleController::class, 'deleteClassActivity'])->name('activitydetails.delete');

    //Manage Result
    Route::get('/assessment_details', [ResultController::class, 'assessmentdetails'])->name('assessmentdetails');
    Route::get('/add_result/{assessid}', [ResultController::class, 'displayResult'])->name('displayResult');
    Route::post('/add_result/{assessid}', [ResultController::class, 'addResult'])->name('addResult');
    // Route::post('/updateResult/{assessid}/{studentid}', [ResultController::class, 'updateResult'])->name('updateResult');

    Route::get('/editResult/{assessid}', [ResultController::class, 'updateResult'])->name('updateResult');
    Route::put('/editResult/{assessid}', [ResultController::class, 'editResult'])->name('editResult');
    // Route::post('/updateResult/{assessid}/{studentid}', [ResultController::class, 'updateResult'])->name('updateResult');
});