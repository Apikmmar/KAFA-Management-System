@extends('layouts.master')

@section('content')
    <div class="text-center mt-4">
        <div>
            <p class="h2 fw-bold">Welcome back, {{ $user->user_name }}</p>
            <p class="h4 fw-bold">Your Action is available on the sidebar</p>
        </div>
        <div>
            <img src="{{ asset('default_image/mantantersakiti.jpeg') }}" class="rounded homekafa" alt="matriye.jpeg">
        </div>
    </div>
@endsection