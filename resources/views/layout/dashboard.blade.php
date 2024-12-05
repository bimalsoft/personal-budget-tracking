<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}"/>
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}"/>
    <title>Argon Dashboard 2 Tailwind by Creative Tim</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet"/>
    <!-- Popper -->
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <!-- Main Styling -->
    <link rel="stylesheet" href="{{asset('assets/css/coustom.css')}}">
    <link href="{{asset('assets/css/argon-dashboard-tailwind.css')}}" rel="stylesheet"/>


</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
<!-- sidenav  -->

@include('components.dashboard.sideNav')

<!-- end sidenav -->

<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <!-- Navbar -->
    @include('components.dashboard.nav')
    <!-- end Navbar -->

    <!-- content -->
    @yield('component')
    <!-- end cards -->
</main>

</body>
<!-- plugin for charts  -->
<script src="{{asset('assets/js/plugins/chartjs.min.js')}}" async></script>
<!-- plugin for scrollbar  -->
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}" async></script>
<!-- main script file  -->
<script src="{{asset('assets/js/argon-dashboard-tailwind.js')}}" async></script>
<!-- sweetalert -->
<script src="{{asset('assets/js/sweet-alert.min.js')}}" async></script>
</html>
