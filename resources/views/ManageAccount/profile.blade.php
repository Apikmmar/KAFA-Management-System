@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <form action="" method="post">
                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <div class="row mb-3">
                        <label for="user_ic" class="col-md-4 col-form-label text-md-end">{{ __('Identity Card Number') }}</label>
        
                        <div class="col-md-4">
                            <input id="user_ic" type="text" class="form-control" name="icnumber" value="{{ $user->user_ic }}" required>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-12">
                    <div class="row mb-3">
                        <label for="user_ic" class="col-md-4 col-form-label text-md-end">{{ __('Full Name') }}</label>
        
                        <div class="col-md-4">
                            <input id="user_ic" type="text" class="form-control" name="icnumber" value="{{ $user->user_name }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row mb-3">
                        <label for="user_ic" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
        
                        <div class="col-md-4">
                            <select id="gender" name="gender" class="form-select" aria-label="Gender">
                                <option value="">Select</option>
                                <option value="Men" {{ $user->user_gender === 'Men' ? 'selected' : '' }}>Men</option>
                                <option value="Women" {{ $user->user_gender === 'Women' ? 'selected' : '' }}>Women</option>
                            </select>
                        </div>                        
                    </div>
                </div>
    
                <div class="col-md-12">
                    <div class="row mb-3">
                        <label for="user_ic" class="col-md-4 col-form-label text-md-end">{{ __('Contact') }}</label>
        
                        <div class="col-md-4">
                            <input id="user_ic" type="text" class="form-control" name="icnumber" value="{{ $user->user_contact }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row mb-3">
                        <label for="user_ic" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
        
                        <div class="col-md-4">
                            <input id="user_ic" type="email" class="form-control" name="icnumber" value="{{ $user->email }}" required>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-12">
                    <div class="row mb-3">
                        <label for="user_ic" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
        
                        <div class="col-md-4">
                            <input id="user_ic" type="text" class="form-control" name="icnumber" value="{{ $user->user_ic }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row mb-3">
                        <label for="user_ic" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
        
                        <div class="col-md-4">
                            <input id="user_ic" type="text" class="form-control" name="icnumber" value="{{ $user->user_ic }}" required>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-12">
                    <div class="row mb-3">
                        <label for="user_ic" class="col-md-4 col-form-label text-md-end">{{ __('Identity Card') }}</label>
        
                        <div class="col-md-4">
                            <input id="user_ic" type="text" class="form-control" name="icnumber" value="{{ $user->user_ic }}" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection