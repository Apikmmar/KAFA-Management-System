@extends('layouts.master')

@section('content')
    <div>
        <div class="card-header">
                <h3>LIST OF FEEDBACKS</h3>
        </div><br>

        <div class="col-12 col-xl-6">
            <div class="card">

                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>List of Feedback</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Adab Subject Grade for Year 2</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Percentage of Year 2 Students Who Passed All Subject</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Percentage of Year 2 Students Who Failed All Subject</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>


            </div>
        </div>



















    </div>
@endsection