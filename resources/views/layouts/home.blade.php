<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ url('frontend/images/logo.png') }}">
    
    @yield('title')
    
    @include('includes.user.style')

</head>

<body>
    @include('includes.user.navbar')

    @yield('content')

    @include('includes.user.footer')

    @include('sweetalert::alert')
</body>

@include('includes.user.script')

</html>