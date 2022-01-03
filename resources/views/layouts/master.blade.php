<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kinntegra Business Private Limited</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" href="/favicon.ico" type="image/ico" sizes="16x16">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('modules/fullcalendar/main.css') }}" />
    <link rel="stylesheet" media="screen" type="text/css" href="{{ asset('assets/stylesheet/colorpicker.css') }}" />
    <link href="{{ asset('modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/stylesheet/style.css') }}" />

    @yield('style')
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
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
    </style>
</head>

<body>
@if (Auth::check())
    @include('partials.fonts')
    @if (Auth::user()->hasRole("superadmin"))

    @endif
    <div class="body-wrapper">
        @include('partials.mobile_header')

        @include('partials.header')

        <main>
            @yield('content')
        </main>
    </div>

    @yield('modal')
    <div class="modal fade" id="error_modal" tabindex="-1" role="dialog" aria-labelledby="ErrorModal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Server Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div class="card card-sm">
                        <div class="card-body">
                            <ul class="alerts-lists">

                                @foreach ($errors->all() as $error)
                                    <li><h5>{{ $error }}</h5></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">

                    <button type="button" class="btn btn-primary ml-3 btn-width-lg" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-backdrop"></div>
    <!--Loader-->
    @include('partials.loader')
    <!--End-->

    <script src="{{ asset('modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('modules/bootstrap-daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('modules/bootstrap/js/dist/util.js') }}"></script>
    <script src="{{ asset('modules/bootstrap/js/dist/collapse.js') }}"></script>
    <script src="{{ asset('modules/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('modules/bootstrap/js/dist/dropdown.js') }}"></script>
    <script src="{{ asset('modules/bootstrap/js/dist/tab.js') }}"></script>

    <script src="{{ asset('modules/bootstrap/js/dist/tooltip.js') }}"></script>

    <script src="{{ asset('modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('modules/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('modules/bootstrap/js/dist/modal.js') }}"></script>
    <script src="{{ asset('modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('modules/jquery-validation/dist/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('assets/javascript/common.js') }}"></script>
    <script src="{{ asset('assets/javascript/mycommon.js') }}"></script>

    <script>
        // CSRF for all ajax call
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();

            @if (isset($errors) && $errors->any())
                $('#error_modal').modal('show');
            @endif
    });
    </script>
    @yield('script')
@endif
</body>

</html>
