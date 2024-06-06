<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@extends('layouts.master')

@section('content')
<div class="container mt-3 mb-3">
    <div class="text-center" style="margin-bottom:2%">
            <h2 class="text-2xl">Assessment List</h2>
    </div>

    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" id="error-message">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Session</th>
                    <th>Assessment</th>
                    <th>Subject</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $result)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $assessment->session }}</td>
                        <td>{{ $assessment->assessment }}</td>
                        <td>{{ $assessment->subject }}</td>
                        <td>
                            <a href="{{ route('assessmentdetails', $assessment->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection