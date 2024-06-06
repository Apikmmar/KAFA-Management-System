@extends('layouts.master')

@section('content')
    <div>
        <div class="mb-3 error-placeholder">
            <select class="form-select" style="width: 400px;" name="validation-select">
                <option value>Examination</option>
                    <option value="awal">Ujian Awal Tahun</option>
                    <option value="pertengahan">Ujian Pertengahan Tahun</option>
                    <option value="akhir">Ujian Akhir Tahun</option>
            </select>
        </div>

        <div class="mb-3 error-placeholder">
            <select class="form-select" style="width: 400px;" name="validation-select">
                <option value>Year</option>
                    <option value="2020">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
            </select>
        </div>

        <div class="mb-3 error-placeholder">
            <select class="form-select" style="width: 400px;" name="validation-select">
                <option value>Class</option>
                <option value="">Year 1</option>
                <option value="2020">Year 2</option>
                <option value="2021">Year 3</option>
                <option value="2022">Year 4</option>
                <option value="2023">Year 5</option>
                <option value="2024">Year 6</option>
            </select>
        </div>

        <div class="mb-3 d-flex justify-content-left">
            <button type="submit" align-items: center class="btn btn-primary">Search</button>
            <a href="{{route('gradeReport')}}">
                {{-- {{ __('View') }} --}}
            </a>
        </div>

        {{-- <a href="{{route('gradeReport')}}" class="btn btn-secondary">
            {{ __('View') }}
        </a> --}}

        


      
        















    </div>
@endsection