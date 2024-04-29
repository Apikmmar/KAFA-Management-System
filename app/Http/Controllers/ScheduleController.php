<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassRequest;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

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