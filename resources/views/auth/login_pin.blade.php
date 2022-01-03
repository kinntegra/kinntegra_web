@extends('layouts.guest_new')

@section('style')
<style>
    a{
        font-weight: 600;
        font-size: 12px;
    }
</style>
@endsection

@section('content')
<div class="card auth-card">
    <div class="card-body">
        <div class="logo-wrap">
            <img class="img-fluid" src="{{URL::asset('/assets/images/logo.svg')}}" alt="Kinntegra">
        </div>
        <form method="POST" action="{{ route('loginpin') }}">
            @csrf

            <div class="form-group">
                <label for="user-pin">PIN</label>
                <input type="password" id="pin" class="form-control @error('pin') is-invalid @enderror" placeholder="" name="pin" autocomplete="pin">
                @error('pin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button class="btn btn-primary w-100 btn-lg text-uppercase" type="submit">Sign In</button>

            <div class="mt-3 text-center">
                <a href="{{ route('password.request', ['target'=>'Forgot PIN']) }}">{{ __('Forgot PIN') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
