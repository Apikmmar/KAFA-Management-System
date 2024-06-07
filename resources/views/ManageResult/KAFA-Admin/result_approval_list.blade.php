@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Result Submission Approval</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Session</th>
                                <th>Assessment</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $examination['School_Session'] }}</td>
                                    <td>{{ $examination['Exam_Type'] }}</td>
                                    <td>{{ $classroom['Class_Name'] }}</td>
                                    <td>{{ $subject['Subject_Name'] }}</td>
                                    <td>{{ $examination['Approval_Status'] }}</td>
                                    <td>
                                        <!-- <a href="{{ route('result-submission-approval.view', $result['id']) }}" class="btn btn-primary">View</a> -->
                                        @if($examination['Approval_Status'] == 'pending')
                                            <form action="{{ route('result-submission-approval.approve', $result['id']) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('result-submission-approval.reject', $result['id']) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection