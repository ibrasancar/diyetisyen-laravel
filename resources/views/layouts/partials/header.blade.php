<header class="header d-flex flex-row">
    <div class="header_content d-flex flex-row align-items-center">
        <!-- Logo -->
        <div class="logo_container">
            <div class="logo">
                <a href="{{ route('anasayfa') }}"><img src="/images/logo.png" alt="" style="width: 43px"></a>
                <a href="{{ route('anasayfa') }}"><span>diyetisyen</span></a>
            </div>
        </div>

        <!-- Main Navigation -->
        @include('layouts.partials.main_menu')

    </div>

    <div class="header_side d-flex flex-row justify-content-center align-items-center">
        <img src="/images/phone-call.svg" alt="">
        <span>+90 850 850 50 50</span>
    </div>

    <!-- Hamburger -->
    <div class="hamburger_container">
        <i class="fas fa-bars trans_200"></i>
    </div>

</header>

@include('layouts.partials.mobile_menu')
