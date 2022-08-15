<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!--Basic Styles-->
     <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/weather-icons.min.css')}}" rel="stylesheet" />
   
    <!--Fonts-->
    <link href='../fonts.googleapis.com/css@family=open+sans_3a300italic,400italic,600italic,700italic,400,600,700,300.css'
          rel="stylesheet" type="text/css">

    <!--Beyond styles-->

    <!-- <link id="beyond-link" href="{{asset('assets/css/beyond.min.css')}}" rel="stylesheet" /> -->

    <link href="{{ asset('assets/css/beyond.min.css') }}" rel="stylesheet" type="text/css" />

    

    <link href="{{asset('assets/css/demo.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/typicons.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="{{asset('phq/footer/css/style.css')}}"> -->

  

    <script src="{{asset('assets/js/skins.min.js')}}"></script>

   
    
    <title>@yield('title', config('app.name'))</title>
   
    @yield('custom_css')
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
 

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
            @yield('content')
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
           
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

   
    @yield('custom_js')
</body>
</html>
