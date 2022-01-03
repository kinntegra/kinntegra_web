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
            <img class="img-fluid" src="/assets/images/logo.svg" alt="Kinntegra">
        </div>
            <h3 class="card-title text-center">{{ $title }}</h3>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="username">PAN NO</label>
                <input type="text" id="username" class="form-control  text-uppercase @error('username') is-invalid @enderror" name="username" required>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button class="btn btn-primary w-100 btn-lg text-uppercase" type="submit">RESET</button>
            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Back to Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
