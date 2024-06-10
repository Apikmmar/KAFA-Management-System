<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@extends('layouts.master')

@section('content')
<div class="container mt-3 mb-3">
    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif
    <div class="text-center" style="margin-bottom:2%">
        <h2 class="text-2xl">Assessment List</h2>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" id="error-message">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="" method="get">

        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="form-group row">
                    <label for="school_session" class="col-md-4 col-form-label text-md-right">Session Year</label>

                    <div class="col-md-6">
                        <select id="school_session" class="form-control @error('school_session') is-invalid @enderror"
                            name="school_session">
                            @for ($school_session = date('Y') - 1; $school_session <= date('Y') + 10; $school_session++)
                                @if ($school_session == date('Y'))
                                    <option value="{{ $school_session }}" selected>{{ $school_session }}</option>
                                @else
                                    <option value="{{ $school_session }}">{{ $school_session }}</option>
                                @endif
                            @endfor
                        </select>

                        @error('school_session')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                &nbsp;&nbsp;
                <!-- Add a margin bottom of 20px to separate form groups -->
                <div style="margin-bottom: 20px;"></div>

                <div class="form-group row">
                    <label for="exam_type" class="col-md-4 col-form-label text-md-right">Assessment
                        Type</label>

                    <div class="col-md-6">
                        <select id="exam_type" class="form-control @error('exam_type') is-invalid @enderror"
                            name="exam_type">
                            <option value="Ujian Awal Tahun">Ujian Awal Tahun</option>
                            <option value="Ujian Pertengahan Tahun">Ujian Pertengahan Tahun</option>
                            <option value="Ujian Akhir Tahun">Ujian Akhir Tahun</option>
                        </select>

                        @error('exam_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>

    </form>

    <br>

    <div class="box">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Session</th>
                    <th>Assessment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $num = 1;
                @endphp
                @foreach ($assessments as $assessment)
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td>{{ $assessment->school_session }}</td>
                                    <td>{{ $assessment->exam_type }}</td>
                                    <td>
                                        @if($assessment->results->isNotEmpty())
                                            {{ $assessment->results->first()->result_status }}
                                        @else
                                            Not Available
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('displayResult', ['assessid' => $assessment->id]) }}"
                                            class="btn btn-primary">Add</a>
                                        <a href="{{ route('updateResult', ['assessid' => $assessment->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                    </td>
                                </tr>

                                @php
                                    $num++;
                                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection