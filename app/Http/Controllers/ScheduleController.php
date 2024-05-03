<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassRequest;
use App\Models\Activity;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    //
    public function allclass() {
        $classes = Classroom::all();

        return view('ManageSchedule.KAFA-Admin.all_class', compact('classes'));
    }

    public function viewclassroom($id) {
        $class = Classroom::findOrFail($id);
        $students = Student::whereNotNull('classroom_id')->get();

        return view('ManageSchedule.KAFA-Admin.view_classroom', compact('class', 'students'));
    }

    public function addclassroom() {
        $teachers = User::all()->where('role_id', 4);
        $students = Student::all()->where('classroom_id', null);

        return view('ManageSchedule.KAFA-Admin.add_classroom', compact('teachers', 'students'));
    }

    public function classactivity() {
        $user = Auth::user();

        $class = Classroom::where('teacher_id', $user->id)->first();

        $activities = $class->activities;

        $activities->transform(function ($activity) {
            $activity->activity_date = Carbon::parse($activity->activity_date)->format('j F Y');
            $activity->activity_starttime = Carbon::parse($activity->activity_starttime)->format('h:i A');
            $activity->activity_endtime = Carbon::parse($activity->activity_endtime)->format('h:i A');

            return $activity;
        });

        return view('ManageSchedule.Teacher.class_activity', compact('class', 'activities'));
    }

    public function newactivity() {

        return view('ManageSchedule.Teacher.new_activity');
    }

    public function activitydetails($id) {
        $activity = Activity::findOrFail($id);

        return view('ManageSchedule.Teacher.activity_details', compact('activity'));
    }

    public function createClassroom(CreateClassRequest $request) {
        $data = $request->validated();
        
        $class = Classroom::create([
            'class_name' => $data['class_name'],
            'class_description' => $data['class_description'],
            'teacher_id' => $data['class_teacher'],
        ]);

        $class->save();

        $selectedStudentIds = $request->input('add_std');

        foreach($selectedStudentIds as $std_id) {
            $student = Student::findOrFail($std_id);
            $student->classroom_id = $class->id;
            $student->save();
        }
        
        return redirect()->route('addclassroom')->with('message', 'Successfully Create New Class');
    }
}