@extends('layouts.master')

@section('content')
    <div>
        @if(session('message'))
            <div class="alert alert-info" id="success-message">
                {{ session('message') }}
            </div>
        @endif

        @if(session('deletemessage'))
            <div class="alert alert-info" id="success-message">
                {{ session('deletemessage') }}
            </div>
        @endif

        <br>
        <h3 style="margin-left: 20px;"><b>NOTICE</b></h3>

        <div class="d-flex justify-content-end" style="margin-top: -42px; margin-right: 20px;">
            <a href="{{route('noticeform')}}" class="btn btn-primary">
                {{ __('Create') }}
            </a>
        </div>
        <br><br>

        <div class="container">
            <div class="row align-items-start">
                <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 40px;">
                    Title
                </div>
                <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 40px;">
                    Apply Date
                </div>
                <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 40px;">
                    Status
                </div>
                <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 40px;">
                    Action
                </div>
            </div>
            <br><br>

            @foreach($notices as $notice)
                <div class="row mb-3">
                    <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 40px;">
                        {{ $notice->notice_title }}
                    </div>
                    <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 40px;">
                        {{ \Carbon\Carbon::parse($notice->notice_submission_date)->format('Y-m-d') }}
                    </div>
                    <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 40px;">
                        {{ $notice->notice_status }}
                    </div>
                    <div class="col text-center d-flex align-items-center justify-content-center" style="border: 1px solid black; height: 40px;">
                    <form action="{{ route('deletenotice', $notice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this notice?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection