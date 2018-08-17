<!DOCTYPE html>
<html lang="tr">
<head>
    <title>@yield('title')</title>
    @include('layouts.partials.head')
    @yield('style')
</head>
<body>

<div class="super_container">

    <!-- Header -->

    @include('layouts.partials.header')

    <!-- Menu -->


    @yield('content')

    <!-- Footer -->

    @include('layouts.partials.footer')

</div>

@include('layouts.partials.scripts')

@stack('scripts')
</body>
</html>