@extends('layouts.master')

@section('content')
    <div>
        <div class="card-header">
                <h3>REPORT>LIST OF SUBJECTS</h3>
        </div><br>

        <div class="col-12 col-xl-6">
            <div class="card">

                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>List of Subjects</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Al-Quran</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Bidang Al Quran</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Ulum Syariah</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                           <td>Sirah</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Adab</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Jawi dan Khat</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Lughatul Quran</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Penghayatan Cara Hidup Islam</td>
                            <td class="text-end">
                                {{-- <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a> --}}
                                <a href="{{route('searchExam')}}" class="btn btn-primary btn-sm">                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>Amali Solat</td>
                            <td class="text-end">
                                <a href="#"><i class="align-middle fas fa-fw fa-eye"></i></i></a>
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