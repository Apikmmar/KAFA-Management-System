<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\CreateClassRequest;
use App\Http\Requests\UpdateActivityRequest;
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

        $activities = $class->activities()->orderBy('activity_date')->orderBy('activity_starttime')->get();

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

    public function childkafa() {
        $parent = Auth::user();
        $childs = Student::where('parent_id', $parent->id)->get();

        return view('ManageSchedule.Parent.child_kafa', compact('childs'));
    }

    public function kafaschedule($id) {
        $activities = Activity::where('classroom_id', $id)->get();

        $activities->transform(function ($activity) {
            $activity->activity_date = Carbon::parse($activity->activity_date)->format('j F Y');
            $activity->activity_starttime = Carbon::parse($activity->activity_starttime)->format('h:i A');
            $activity->activity_endtime = Carbon::parse($activity->activity_endtime)->format('h:i A');

            return $activity;
        });

        $todayDate = Carbon::now();

        $nextDates = [];
        for ($i = 1; $i <= 5; $i++) {
            $nextDates[] = Carbon::parse($todayDate->addDays()->toDateString())->format('j F Y');
        }
        
        return view('ManageSchedule.Parent.kafa_schedule', compact('activities', 'nextDates'));
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

    public function createClassActivity(CreateActivityRequest $request) {
        $data = $request->validated();

        $user = Auth::user();
        $class = Classroom::where('teacher_id', $user->id)->first();

        $activity = Activity::create([
            'classroom_id' => $class->id,
            'activity_name' => $data['activity_name'],
            'activity_description' => $data['activity_description'],
            'activity_date' => $data['activity_date'],
            'activity_starttime' => $data['activity_starttime'],
            'activity_endtime' => $data['activity_endtime'],
            'activity_remarks' => $data['activity_remarks'],
        ]);

        $activity->save();

        return redirect()->route('classactivity')->with('message', 'Successfully Create New Activity');
    }

    public function updateClassActivity(UpdateActivityRequest $request, $id) {
        $activity = Activity::findOrFail($id);

        $validatedData = $request->validated();

        $activity->update([
            'activity_name' => $validatedData['activity_name'],
            'activity_description' => $validatedData['activity_description'],
            'activity_date' => $validatedData['activity_date'],
            'activity_starttime' => $validatedData['activity_starttime'],
            'activity_endtime' => $validatedData['activity_endtime'],
            'activity_remarks' => $validatedData['activity_remarks'],
        ]);

        return redirect()->route('activitydetails', ['id' => $activity->id])->with('message', 'Successfully Update Activity');
    }

    public function deleteClassActivity($id) {
        $activity = Activity::findOrFail($id);

        $activity->delete();

        return redirect()->route('classactivity')->with('message', 'Successfully Delete Activity');
    }
}