@extends('layouts.external')

@section('style')
<style>
    .termsx {
overflow-y: scroll;
height: 300px;
width: 100%;
border: 1px solid #DDD;
padding: 10px;
}
.w-5 {
    width: 5% !important;
}
.w-10 {
    width: 10% !important;
}
.w-15 {
    width: 15% !important;
}
    </style>

@endsection

@section('content')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="text-center">
                            <img src="http://127.0.0.1:8001/assets/images/logo.svg" class="rounded mx-auto d-block w-10 p-3">
                            <h3 style="margin-top: 7px;font-size: 25px;margin-left:10px;">Kinntegra Wealth Solution Private Limited</h3>
                     </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="text-center">
                        <h3 style="margin-top: 7px;font-size: 23px;margin-left:10px;">Thanks</h3>
                        <p>Your account verification request forwarded to your associate for further action.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection

@section('modal')

<!-- Modal -->


@endsection

@section('script')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script type="text/javascript" src="{{ asset('external/js/associate.js') }}"></script>
<script>

</script>
@endsection
