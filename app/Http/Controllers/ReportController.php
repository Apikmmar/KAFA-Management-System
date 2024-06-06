<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //display report page (MUIP)
    public function listSubject() {
        $user = Auth::user(); // retrieve user authentication

        return view('ManageReport.MUIP-Admin.listSubject', compact('user'));
    }

    public function searchExam() {
        $user = Auth::user(); // retrieve user authentication

        return view('ManageReport.MUIP-Admin.searchExam', compact('user'));
    }

    public function gradeReport() {
        $user = Auth::user(); // retrieve user authentication

        return view('ManageReport.MUIP-Admin.gradeReport', compact('user'));
    }

    public function listClass() {
        $user = Auth::user(); // retrieve user authentication

        return view('ManageReport.MUIP-Admin.listClass', compact('user'));
    }

    public function searchClass() {
        $user = Auth::user(); // retrieve user authentication

        return view('ManageReport.MUIP-Admin.searchClass', compact('user'));
    }

    //display feedback (KAFA)
    public function viewFeedback() {
        $user = Auth::user(); // retrieve user authentication

        return view('ManageReport.KAFA-Admin.listFeedback', compact('user'));
    }
}

