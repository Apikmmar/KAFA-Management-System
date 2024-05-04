@extends('layouts.master')

@section('content')
    <div class="container mt-3 mb-3">
    @if(session('message'))
        <div class="alert alert-info" id="success-message">
            {{ session('message') }}
        </div>
    @endif
        <div class="container">
            <h1 class="text-center">Weekly Timetable</h1>
            <table class="table table-bordered timetable">
                <thead>
                    <tr>
                        <th>Time</th>
                        @foreach($nextDates as $date)
                            <th>{{ $date }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                @php
                    $startTime = \Carbon\Carbon::parse('2:00 PM');
                    $endTime = \Carbon\Carbon::parse('6:00 PM');
                    $timeIncrement = $startTime->copy();
                @endphp
                @while ($timeIncrement < $endTime)
                    <tr>
                        <td>{{ $timeIncrement->format('h:i A') }} - {{ $timeIncrement->addMinutes(30)->format('h:i A') }}</td>
                        @foreach ($nextDates as $date)
                            <td>
                                @foreach ($activities as $activity)
                                    @if ($activity->activity_date == $date && 
                                        \Carbon\Carbon::parse($activity->activity_endtime)->between(
                                            \Carbon\Carbon::parse($timeIncrement)->addMinutes(30), 
                                            \Carbon\Carbon::parse($timeIncrement)
                                        ))
                                        {{ $activity->activity_name }}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endwhile
                </tbody>
            </table>            
        </div>
    </div>

    <style>
        .timetable {
          margin-top: 20px;
        }
        .timetable th,
        .timetable td {
          text-align: center;
          vertical-align: middle;
          border: 1px solid #dee2e6;
          padding: 10px;
        }
        .timetable th {
          background-color: #f8f9fa;
        }
    </style>
@endsection