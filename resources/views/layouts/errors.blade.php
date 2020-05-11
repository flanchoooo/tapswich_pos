<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{env('SYS_NAME')}}</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css' ) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('datatable/font.css' ) }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('datatable/datatable.css')}}" rel="stylesheet">
    <link href="{{asset('datatable/buttons.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/button.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/datatablejQueryMin.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/buttondatatablejQueryMin.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/pdf.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/pdf2.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/html5buttons.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/print.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/dataTable.swf')}}"></script>

</head>
<body class="bg-gradient-primary">
<div class="container">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    @yield('content')
</div>
</body>
</html>

