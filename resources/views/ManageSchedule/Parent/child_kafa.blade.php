@extends('layouts.master')

@section('content')
    <div class="container mt-3 mb-3">
    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif
        <div>
            @foreach ($childs as $item)
                {{ $item }}
            @endforeach
        {{-- @if ($childs->isNotEmpty())
            <p class="h3 fw-bold">{{ $class->class_name }} Activity</p>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Activity Name</th>
                    <th scope="col">Activity Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">Manage</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $num = 1
                @endphp
                @foreach ($activities as $activity)
                    <tr>
                    <th scope="row">{{ $num }}</th>
                    <td>{{ $activity->activity_name }}</td>
                    <td>{{ $activity->activity_description }}</td>
                    <td>{{ $activity->activity_date }}</td>
                    <td>{{ $activity->activity_starttime }} - {{ $activity->activity_endtime }}</td>
                    <td>{{ $activity->activity_remarks }}</td>
                    <td>
                        <a href="{{ route('activitydetails', ['id' => $activity->id]) }}" class="btn btn-sm btn-info fw-bold text-white">Edit</a>
                    </td>
                    </tr>
                    @php
                        $num++
                    @endphp
                @endforeach
                </tbody>
            </table>
        @else
            <div class="d-flex justify-content-center">
                <p class="h4 fw-bold">No Activity Created Yet</p>
            </div>
        @endif --}}
        </div>
    </div>
@endsection