@extends('layouts.guest_new')

@section('style')
<style>
    a{
        font-weight: 600;
        font-size: 12px;
    }
    .d-account{
        font-size: 14px;
        color: #545454;

    }
</style>
@endsection

@section('content')
<div class="card auth-card">
    <div class="card-body">
        <div class="logo-wrap">
            <img class="img-fluid" src="{{URL::asset('/assets/images/logo.svg')}}" alt="Kinntegra">
        </div>
        <h3 class="card-title text-center">Login to Kinntegra</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf



            <div class="form-group">
                <label for="user-id">PAN NO</label>
                <input type="text" id="username" class="form-control  text-uppercase @error('username') is-invalid @enderror" placeholder="" name="username" required autofocus>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="" required>

            </div>
            <button class="btn btn-primary w-100 btn-lg text-uppercase" type="submit">Sign In</button>
            <div class="d-sm-flex mt-3 justify-content-between align-items-center">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request', ['target'=>'Forgot Password']) }}">{{ __('Forgot Password?') }}</a>
                @endif

                <span class="d-block mt-2 mt-sm-0"><span class="d-account">Don't have an account?</span>
                    <a href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                </span>
            </div>
        </form>
    </div>
</div>
@endsection
