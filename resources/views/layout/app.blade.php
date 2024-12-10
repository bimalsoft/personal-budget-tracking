<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{asset('assets/image/favicon.ico')}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Buddy</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/coustom.css')}}">
</head>
<body >
@include('components.header')

<!-- main -->

    @yield('component')


<!-- main -->
@include('components.footer')
</body>
</html>
