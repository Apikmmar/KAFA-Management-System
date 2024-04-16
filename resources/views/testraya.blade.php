@extends('layouts.master')

@section('content')
    <div class="text-start">
        <p class="h2">SELAMAT HARI RAYA AIDIL FITRI MAAF ZAHIR DAN BATIN {{ $user->role->role_name }} {{ $user->user_name }}</p>
        <img src="{{ asset('default_image/mantantersakiti.jpeg') }}" class="rounded" alt="matriye.jpeg">
    </div>
@endsection