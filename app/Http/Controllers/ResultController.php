<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Http\Requests\CreateSessionRequest;
use App\Models\Classroom;
use App\Models\Examination;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function assessmentdetails()
    {
        // Get the current year as a string
        $currentYear = strval(Carbon::now()->year);

        // Retrieve examinations for the current year
        $assessments = Examination::where('school_session', $currentYear)->get();

        return view('ManageResult.Teacher.assessment_details', compact('assessments'));
    }

    public function displayResult(Request $request, $assessid)
    {
        $assessment = Examination::findOrFail($assessid);
        $subjects = Subject::all();
        $subject = $request->subject_name;
        $students = collect(); // Define an empty collection by default

        if (
            $subject === 'Bidang Al Quran' || $subject === 'Ulum Syariah' || $subject === 'Sirah' ||
            $subject === 'Adab' || $subject === 'Jawi Dan Khat' || $subject === 'Lughatul Quran' ||
            $subject === 'Penghayatan Cara Hidup Islam' || $subject === 'Amali Solat'
        ) {
            $id = Auth::id();
            $class = Classroom::where('teacher_id', $id)->first();

            if ($class) {
                $subsid = Subject::where('subject_name', $subject)->first();
                $students = Student::where('classroom_id', $class->id)->get();

                return view('ManageResult.Teacher.add_result', compact('assessment', 'subjects', 'students', 'subsid'));
            }
        }

        return view('ManageResult.Teacher.add_result', compact('assessment', 'subjects', 'students',));
    }


    public function addResult(CreateResultRequest $request)
    {
        $userid = Auth::id();

        $data = $request->validated();
        $gradestd = 'N';

        $results = [];
        foreach ($request->student_ids as $student_id) {

            if ($request->result_marks[$student_id] >= 0 && $request->result_marks[$student_id] < 40) {
                $gradestd = 'E';
            } elseif ($request->result_marks[$student_id] >= 40 && $request->result_marks[$student_id] <= 50) {
                $gradestd = 'D';
            } elseif ($request->result_marks[$student_id] > 50 && $request->result_marks[$student_id] <= 60) {
                $gradestd = 'C';
            } elseif ($request->result_marks[$student_id] > 60 && $request->result_marks[$student_id] <= 80) {
                $gradestd = 'B';
            } elseif ($request->result_marks[$student_id] > 80 && $request->result_marks[$student_id] <= 100) {
                $gradestd = 'A';
            } 

            $results[] = [
                'student_id' => $student_id,
                'subject_id' => $request->subs,
                'user_id' => $userid,
                'examination_id' => $request->assessid,
                'result_marks' => $request->result_marks[$student_id],
                'result_feedback' => $request->result_feedback[$student_id],
                'result_grades' => $gradestd,
                'result_status' => 'Pending',
            ];
        }

        DB::transaction(function () use ($results) {
            Result::insert($results); // Insert all records within a transaction
        });

        return redirect()->route('assessmentdetails')->with('message', 'Results added successfully!');
    }


    // public function updateResult(UpdateResultRequest $request, $id)
    // {
    //     $results = Result::where('subject_name', $subject)->where('classroom_id');

    //     $result = Result::findOrFail($id);
    //     $result->update($request->validated());
    //     return redirect()->back()->with('success', 'Result updated successfully.');
    // }


    // display add session page and store data
    public function addSession()
    {
        $examination = Examination::all();

        return view('ManageResult.KAFA-Admin.add_session', compact('examination'));
    }

    public function storeSession(CreateSessionRequest $request)
    {
        $data = $request->validated();

        $examination = Examination::create([

            'school_session' => $data['school_session'],
            'exam_type' => $data['exam_type'],
            'approval_status' => 'Pending',
            'exam_comment' => 'None',
        ]);

        $examination->save();

        return redirect()->route('addsession')->with('success', 'Session created successfully!');
    }

    public function deletesession($id)
    {
        $examination = Examination::findOrFail($id); //fetch all exam based on id
        $examination->delete(); // delete session from database

        return redirect()->route('addsession')->with('success', 'Session deleted successfully!');
    }

    //     public function viewaddresult()
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

    //     // ManageResultController.php

    public function resultapprovallist()
    {
        $results = Result::all(); // fetch all Results

        return view('ManageResult.KAFA-Admin.result_approval_list', compact('results'));
    }

    public function viewresult($id)
    {
        $result = Result::find($id); // fetch specific Result

        return view('ManageResult.KAFA-Admin.student_lists_review', compact('result'));
    }

    public function updateapproval($id)
    {
        $result = Result::find($id); // fetch specific Result

        // Update the result status to approved
        $result->status = 'approved';
        $result->save();

        return redirect()->route('resultapprovallist');
    }

    public function rejectapproval($id)
    {
        $result = Result::find($id); // fetch specific Result

        // Update the result status to rejected
        $result->status = 'rejected';
        $result->save();

        return redirect()->route('resultapprovallist');
    }
    //     }
}
