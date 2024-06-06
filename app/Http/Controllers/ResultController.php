<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Http\Requests\CreateSessionRequest;
use App\Models\Examination;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function assessmentdetails()
    {
        $result = Result::all(); // fetch all Result

        return view('ManageResult.Teacher.assessment_details', compact('result'));
    }

    // display add session page
    public function addsessions()
    {
        $examination = Examination::all(); // fetch all exam

        return view('ManageResult.KAFA-Admin.add_session', compact('result'));
    }

//     public function viewaddresult()
//     {
//         $result = Result::all(); // fetch all Result

//         return view('ManageResult.Teacher.assessment_details', compact('assessment'));
//     }

//     public function addresult()
//     {
//         $result = Result::all(); // fetch all Result

//         return view('ManageResult.Teacher.assessment_details', compact('assessment'));
//     }

//     public function resultdetails()
//     {
//         $result = Result::all(); // fetch all Result

//         return view('ManageResult.Teacher.assessment_details', compact('assessment'));
//     }

//     public function updateresult()
//     {
//         $result = Result::all(); // fetch all Result

//         return view('ManageResult.Teacher.assessment_details', compact('assessment'));
//     }

//     public function selectresultinfo()
//     {
//         $result = Result::all(); // fetch all Result

//         return view('ManageResult.Teacher.assessment_details', compact('assessment'));
//     }

//     public function resultslip()
//     {
//         $result = Result::all(); // fetch all Result

//         return view('ManageResult.Teacher.assessment_details', compact('assessment'));
//     }

//     public function resultapprovallist()
//     {
//         $result = Result::all(); // fetch all Result

//         return view('ManageResult.Teacher.assessment_details', compact('assessment'));
//     }

//     public function studentlistreview()
//     {
//         $result = Result::all(); // fetch all Result

//         return view('ManageResult.Teacher.assessment_details', compact('assessment'));
//     }

//     public function updateapproval()
//     {
//         $result = Result::all(); // fetch all Result

//         return view('ManageResult.Teacher.assessment_details', compact('assessment'));
//     }

//     public function deleteapproval()
//     {
//         $result = Result::all(); // fetch all Result

//         return view('ManageResult.Teacher.assessment_details', compact('assessment'));
//     }
}
