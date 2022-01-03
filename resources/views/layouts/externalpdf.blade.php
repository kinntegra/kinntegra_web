<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Kinntegra</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('/css/mdb-app.css') }}" rel="stylesheet">
        <link href="{{ url('/css/calender.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/css/app.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
        @yield('styles')
    </head>
    <body>
        <div style="overflow: auto; position: absolute; top:0px; bottom: 10px; width: 100%;" class="scrollbar-primary" id="div_content" name="div_content">
            @yield('content')
        </div>

        <script type="text/javascript" src="{{ url('/js/jquery-3.3.1.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="{{ url('/js/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('/js/bootstrap.min.js') }}"></script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });

            function formattoinr(el)
            {
                var ele = el.id;
                var num = $('#' + ele).val();
                if (num !== '')
                {
                    num = num.replace(/,/g, '');
                    var numr = num.replace(/(\d)(?=(\d\d)+\d$)/g, "$1,");

                    $('#' + ele).val(numr);
                }
            };

        </script>

        @yield('scripts')

        <script>
            $(document).ready(function () {
                $(".money-inr").each(function() {
                    formattoinr(this);
                });
            });
        </script>
    </body>
</html>
