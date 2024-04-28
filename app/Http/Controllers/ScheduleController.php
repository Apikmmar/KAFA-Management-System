<?php

namespace App\Http\Controllers;

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

    public function viewclassroom() {
        return view('ManageSchedule.KAFA-Admin.view_classroom');
    }

    public function addclassroom() {
        $teachers = User::all()->where('role_id', 4);
        $students = Student::all()->where('classroom_id', null);

        return view('ManageSchedule.KAFA-Admin.add_classroom', compact('teachers', 'students'));
    }
}
