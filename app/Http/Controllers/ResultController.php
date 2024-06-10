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
use Database\Seeders\StudentSeeder;
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
        $assessments = Examination::with('results')->where('school_session', $currentYear)->get();

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

        return view('ManageResult.Teacher.add_result', compact('assessment', 'subjects', 'students', ));
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

        return redirect()->route('displayResult', ['assessid' => $request->assessid])->with('message', 'Results added successfully!');
    }


    public function updateResult(Request $request, $assessid)
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

                $results = Result::where('examination_id', $assessment->id)->where('subject_id', $subsid->id)->get();

                return view('ManageResult.Teacher.edit_result', compact('assessment', 'subjects', 'students', 'subsid', 'results'));
            }
        }

        return view('ManageResult.Teacher.edit_result', compact('assessment', 'subjects', 'students', ));
    }

    public function editResult(UpdateResultRequest $request)
    {
        $data = $request->validated();
        $resultsToUpdate = [];

        foreach ($request->student_ids as $student_id) {
            $existingResult = Result::where('student_id', $student_id)
                ->where('subject_id', $request->subs)
                ->where('examination_id', $request->assessid)
                ->first();

            if (!$existingResult) {
                continue;
            }

            $marks = $request->result_marks[$student_id];
            $gradestd = 'N';

            if ($marks >= 0 && $marks < 40) {
                $gradestd = 'E';
            } elseif ($marks >= 40 && $marks <= 50) {
                $gradestd = 'D';
            } elseif ($marks > 50 && $marks <= 60) {
                $gradestd = 'C';
            } elseif ($marks > 60 && $marks <= 80) {
                $gradestd = 'B';
            } elseif ($marks > 80 && $marks <= 100) {
                $gradestd = 'A';
            }

            $existingResult->result_marks = $marks;
            $existingResult->result_feedback = $request->result_feedback[$student_id];
            $existingResult->result_grades = $gradestd;
            $existingResult->result_status = 'Pending';

            $resultsToUpdate[] = $existingResult;
        }

        DB::transaction(function () use ($resultsToUpdate) {
            foreach ($resultsToUpdate as $result) {
                $result->save();
            }
        });

        return redirect()->route('assessmentdetails')->with('message', 'Results updated successfully!');
    }


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

    public function selectresultinfo()
    {
        $parent = Auth::user();
        $children = Student::where('parent_id', $parent->id)->pluck('student_name', 'id'); // display student_name based on parents
        $registeredYears = Examination::orderBy('school_session', 'asc')->pluck('school_session')->unique()->toArray();

        return view('ManageResult.Parent.select_result_info', compact('children', 'registeredYears'));
    }

    public function resultslip(Request $request)
    {
        // Find the student
        $student = Student::with('classroom')->findOrFail($request->student_name);

        // Find the examination based on session year and exam type
        $examination = Examination::where('school_session', $request->school_session)
            ->where('exam_type', $request->exam_type)
            ->firstOrFail();

        // Find the results for the student and examination, including subject information
        $results = Result::where('student_id', $student->id)
            ->where('examination_id', $examination->id)
            ->with('subject')
            ->get();

        if ($results->isNotEmpty()) {
            return view('ManageResult.Parent.result_slip', ['student' => $student, 'results' => $results]);
        } else {
            return redirect()->route('result')->with('error', 'Result not found');
        }
    }

    public function resultApprovalList(Request $request)
    {
        $query = Result::with('examination', 'studentresult.classroom', 'subject');
    
        if ($request->has('school_session') && $request->school_session != '') {
            $query->whereHas('examination', function ($q) use ($request) {
                $q->where('school_session', $request->school_session);
            });
        }
    
        if ($request->has('exam_type') && $request->exam_type != '') {
            $query->whereHas('examination', function ($q) use ($request) {
                $q->where('exam_type', $request->exam_type);
            });
        }
    
        $results = $query->get();
    
        return view('ManageResult.KAFA-Admin.result_approval_list', compact('results'));
    }

    
    public function studentListReview($result_id)
    {
        $result = Result::where('id', $result_id)->first();
    
        if (!$result) {
            return redirect()->route('result_approval_list')->with('error', 'Result not found');
        }
    
        return view('ManageResult.KAFA-Admin.student_list_review', compact('result'));
    }
    
    public function updateApproval(Request $request)
    {

    
        $result = Result::findOrFail($request->result_id);
        $result->result_status = 'Approved';
        $result->save();
    
        return redirect()->route('studentlistreview', ['result_id' => $request->result_id])->with('message', 'Result status updated successfully');
    }

    public function deleteapproval(Request $request)
    {
        $result = Result::findOrFail($request->result_id);
        $result->result_status = 'Rejected';
        $result->save();

        return redirect()->route('studentlistreview', ['result_id' => $request->result_id])->with('message', 'Result status updated successfully');
    }
}
