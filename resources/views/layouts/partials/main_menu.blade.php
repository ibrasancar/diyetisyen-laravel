<nav class="main_nav_container">
    <div class="main_nav">
        <ul class="main_nav_list">
            <li class="main_nav_item"><a href="{{ route('anasayfa') }}">anasayfa</a></li>
            @auth
                <li class="main_nav_item"><a href="{{ route('diyetisyen') }}">diyetisyenler</a></li>
                <li class="main_nav_item"><a href="{{ route('kullanici.panel') }}">panelim</a></li>
                <li class="main_nav_item"><a href="{{ route('kullanici.cikis') }}">çıkış yap</a></li>
            @endauth
            @guest
            <li class="main_nav_item"><a href="{{ route('kullanici.kayit') }}">kayıt ol</a></li>
            <li class="main_nav_item"><a href="{{ route('kullanici.giris') }}">giriş yap</a></li>
            @endguest
        </ul>
    </div>
</nav>