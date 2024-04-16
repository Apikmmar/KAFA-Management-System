@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-2">
        <img src="{{ asset('default_image/mantantersakiti.jpeg') }}" class="rounded mx-auto d-block frontimage" alt="kafalogo.jpeg">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row mb-3">
                    <label for="ic_number" class="col-md-4 col-form-label text-md-end">{{ __('Identity Card Number') }}</label>

                    <div class="col-md-6">
                        <input id="ic_number" type="text" class="form-control @error('ic_number') is-invalid @enderror" name="ic_number" value="{{ old('ic_number') }}" required autocomplete="ic_number" autofocus>

                        @error('ic_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn text-white fw-bold reglog_button">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            <br>
            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <a href="{{ route('register') }}" class="btn text-white fw-bold reglog_button">
                        {{ __('Register') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
