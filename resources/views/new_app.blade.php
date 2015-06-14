<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>



    <title>List Maker</title>

    <link href="{{ asset('/css/listAppCustom.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style >
        li{
            padding: 1px;
            cursor: pointer;
        }
    </style>

    <![endif]-->
</head>
<body>

<div class="div-body-frame">
    <div class="div-left-section">
        @yield('left_button_section')
    </div>

    <div class="div-right-form">


            @yield('right_description_section')


            @yield('right_form_section')


            @yield('animated_List_Details_Section')


    </div>
    @yield('content')


    @yield('dummy_section')
</div>

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="{{ asset('/js/lib/jquery.csv.min.js') }}"></script>
<script src="{{ asset('/js/lib/papa.min.js') }}"></script>
<script src="{{ asset('/js/lib/jquery.json.min.js')}}"></script>


@yield('custom_scripts')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
    </script>


</body>
</html>
