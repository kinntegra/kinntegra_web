@extends('layouts.master')

@section('style')

<style>
            #loading{
/* margin: 0px;
padding: 0px; */
position: fixed;
right: 0px;
top: 0px;
width: 100%;
height: 100%;
/* opacity: 0.9; */
z-index: 9999;

background: rgba(255,255,255,1.0);
backdrop-filter: blur(5px);
}

#loading .loader{position: absolute; color: 000; top: 40%; left: 35%;font-size: 25px;text-align: center;}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="col d-flex justify-content-center align-item-center">
        <div class="card col-8">

            <div class="card-body text-center">
                <div class="row">
                    <div class="col-2">
                        <img class="card-img-top" src="/assets/images/right.png" alt="Card image">
                    </div>
                    <div class="col-10">
                        <h3 class="card-title">{{$name}}</h3>
                        <p class="card-text">{{ $data }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')


@endsection
