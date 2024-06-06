@extends('layouts.master')

@section('content')
    <div>
        <div class="card-header">
                <h3>REPORT>CLASS</h3>
        </div><br>

        <div class="col-12 col-xl-6">
            <div class="card">

                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>List of Classes</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Year 1</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchClass')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Year 2</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchClass')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Year 3</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchClass')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                           <td>Year 4</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchClass')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Year 5</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchClass')}}" class="btn btn-primary btn-sm">                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Year 6</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchClass')}}" class="btn btn-primary btn-sm">                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>

    </div>
@endsection