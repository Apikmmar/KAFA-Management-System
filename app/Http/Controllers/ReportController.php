<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Result;
use App\Models\Examination;
use App\Models\Classroom;
use App\Models\Feedback;
use App\Models\Student;

class ReportController extends Controller
{
    //display report page (MUIP)
    public function listSubject() {
        $subjects = Subject::all();

        return view('ManageReport.MUIP-Admin.listSubject', compact('subjects'));
    }

    public function searchExam($id) {
        $examinations = Examination::All(); // retrieve examination
        $classes = Classroom::All();
        $subject = Subject::findOrFail($id);

        return view('ManageReport.MUIP-Admin.searchExam', compact('examinations', 'classes', 'subject'));
    }

    // public function gradeReport(Request $request) {

    //     $examination = Examination::where('id', $request->exam_id)->first();

    //     // Fetch the class record based on the class ID
    //     $class = Classroom::findOrFail($request->class);

    //     // Fetch the students based on the classroom ID
    //     $students = Student::where('classroom_id', $class->id)->get();


    //     // Initialize the results array
    //     $results = [];

    //     // Initialize total students count
    //     $totalStudents = 0;

    //     // Prepare data for the chart
    //     $chartData = [
    //         'labels' => [], // Array to hold grades
    //         'data' => [],   // Array to hold total students for each grade
    //     ];

    //     // Initialize an empty array to store grades and their corresponding student counts
    //     $gradeCounts = [];

    //     foreach ($students as $student) {
    //         $studentResults = Result::where('subject_id', $request->subject)
    //                                 ->where('examination_id', $examination->id)
    //                                 ->get();

    //         foreach ($studentResults as $stdres) {
    //             $grade = $stdres->result_grades;
                
    //             // Increment the count for this grade
    //             if (!isset($gradeCounts[$grade])) {
    //                 $gradeCounts[$grade] = 1;
    //             } else {
    //                 $gradeCounts[$grade]++;
    //             }
    //         }
    //     }

    //     // Now populate chart data with grades and their corresponding student counts
    //     foreach ($gradeCounts as $grade => $count) {
    //         $chartData['labels'][] = $grade; // Store grade as label
    //         $chartData['data'][] = $count;   // Store count as data point
    //     }

    //     return view('ManageReport.MUIP-Admin.gradeReport', compact('chartData'));
    // }

    //display list class 
    public function listClass() {
        $classes = Classroom::all();

        return view('ManageReport.MUIP-Admin.listClass', compact('classes'));
    }

    //display bar chart for student get grade each subject
    public function gradeReport(Request $request) {

        $examination = Examination::where('id', $request->exam_id)->first();
    
        // Fetch the class record based on the class ID
        $class = Classroom::findOrFail($request->class);
    
        // Fetch the students based on the classroom ID
        $students = Student::where('classroom_id', $class->id)->get();
    
        // Initialize an empty array to store grades and their corresponding student counts
        $gradeCounts = [];
    
        foreach ($students as $student) {
            $studentResults = Result::where('student_id', $student->id)
                                    ->where('subject_id', $request->subject)
                                    ->where('examination_id', $examination->id)
                                    ->first();
    
            if ($studentResults) {
                $grade = $studentResults->result_grades;
    
                // Increment the count for this grade
                if (!isset($gradeCounts[$grade])) {
                    $gradeCounts[$grade] = 1;
                } else {
                    $gradeCounts[$grade]++;
                }
            }
        }
    
        // Prepare data for the chart
        $chartData = [
            'labels' => [], // Array to hold grades
            'data' => [],   // Array to hold total students for each grade
        ];
    
        // Now populate chart data with grades and their corresponding student counts
        foreach ($gradeCounts as $grade => $count) {
            $chartData['labels'][] = $grade; // Store grade as label
            $chartData['data'][] = $count;   // Store count as data point
        }
    
        return view('ManageReport.MUIP-Admin.gradeReport', compact('chartData'));
    }
    
    // search class
    public function searchClass() {
        $examination = Examination::All(); // retrieve examination
        $classes = Classroom::All();

        return view('ManageReport.MUIP-Admin.searchClass', compact('classes', 'examination'));
    }

    //display subject chart(pass/fail)
    public function subjectReport(Request $request) {

        $examination = Examination::where('id', $request->exam_id)->first();
    
        // Fetch the class record based on the class ID
        $class = Classroom::findOrFail($request->class);
    
        // Fetch the students based on the classroom ID
        $students = Student::where('classroom_id', $class->id)->get();
    
        // Initialize counters for passed and failed students
        $passCount = 0;
        $failCount = 0;
    
        foreach ($students as $student) {
            $studentResults = Result::where('student_id', $student->id)
                                    ->where('subject_id', $request->subject)
                                    ->where('examination_id', $examination->id)
                                    ->first();
    
            if ($studentResults) {
                $mark = $studentResults->result_marks; // Assuming `result_marks` holds the actual marks
    
                if ($mark >= 40) {
                    $passCount++;
                } else {
                    $failCount++;
                }
            }
        }
    
        // Prepare data for the pie chart
        $chartData = [
            'labels' => ['Passed', 'Failed'],
            'data' => [$passCount, $failCount],
        ];
    
        return view('ManageReport.MUIP-Admin.subjectReport', compact('chartData'));
    }

    //add feedback
    public function addFeedback() {
        $feedback = Feedback::All(); // retrieve examination

        return view('ManageReport.MUIP-Admin.searchClass', compact('feedback'));
    }

    //display feedback (KAFA)
    public function viewFeedback() {
        $user = Auth::user(); // retrieve user authentication

        return view('ManageReport.KAFA-Admin.listFeedback', compact('user'));
    }
}

