<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('tilte')</title>
    @yield('css')
</head>
<body id="app-layout">
<div>
    @include('layout.header')
</div>
<div>
    @yield('content')
</div>
<div>
    @include('layout.footer')
</div>
@yield('modals')
@yield('script')
</body>
</html>
