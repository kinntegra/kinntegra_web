<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">


        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/stylesheet/style.css') }}">
        <style>
            .company-info{
                color: #c7dfd1;
            }
        </style>
        @yield('style')
        @yield('script')
    </head>
    <body class="auth-page">
        <div class="auth-wrapper">

            @yield('content')

            <div class="text-center company-info">
                Kinntegra Business Solutions Pvt. Ltd. | CIN:
                U74999MH2018PTC306145
                <br>&nbsp;AMFI Registration No: ARN-145633  | BSE StarMF Member ID - 19941
            </div>
        </div>


    </body>
</html>
