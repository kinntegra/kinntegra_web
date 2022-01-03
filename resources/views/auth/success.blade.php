@extends('layouts.guest_new')

@section('style')
<style>
    a{
        color: #a3a3a3;
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
        <br/><br/>
        <div class="card-text text-center">
            {{ $message }}
        </div>
        <br/><br/><br/>
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="btn btn-primary w-100 btn-lg text-uppercase">Back to Login</a>
        </div>
    </div>
</div>
@endsection
