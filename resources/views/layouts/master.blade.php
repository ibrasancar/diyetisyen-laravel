<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    @include('layouts.partials.head')
    @yield('styles')
</head>
<body data-spy="scroll" data-target="#pb-navbar" data-offset="200">

    @include('layouts.partials.main_menu')

    @yield('content')

    @include('layouts.partials.footer')

</body>
</html>