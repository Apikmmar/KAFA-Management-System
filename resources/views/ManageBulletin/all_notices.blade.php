@extends('layouts.master')

@section('content')
    <div>
        @if(session('message'))
            <div class="alert alert-info" id="success-message">
                {{ session('message') }}
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
            
        </div>
    </div>
@endsection