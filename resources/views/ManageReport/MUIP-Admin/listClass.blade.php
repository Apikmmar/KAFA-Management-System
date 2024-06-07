@extends('layouts.master')

@section('content')
    <div>
        <div class="card-header">
            <h3>REPORT>LIST OF CLASS</h3>
        </div><br>

    <div class="col-12 col-xl-6">
        <div class="card">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>List of Class</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->class_name }}</td>
                        <td class="text-end">
                            <a href="{{route('searchExam', ['id' => $class->id])}}" class="btn btn-primary btn-sm">
                                {{ __('View') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
@endsection