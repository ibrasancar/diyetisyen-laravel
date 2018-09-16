<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="{{ route('anasayfa') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link {{ (\Request::route()->getName() == 'anasayfa') ? 'active' : '' }}" href="{{ route('anasayfa') }}">Anasayfa</a>
                {{--<span class="sr-only">(current)</span>--}}
            </li>
            @auth
                <li class="nav-item {{ Request::is('diyetisyen*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('diyetisyen') }}">Diyetisyenler</a>
                </li>
                <li class="nav-item {{ Request::is('kullanici/panel*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kullanici.panel') }}">Panelim</a>
                </li>
                <li class="nav-item {{ Request::is('mesaj*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mesaj.alinanlar') }}">
                        Mesajlar <span class="badge {{ $okunmamis_mesaj_sayisi > 0 ? 'badge-danger' : 'display_none' }}">{{ $okunmamis_mesaj_sayisi }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kullanici.cikis') }}">Çıkış</a>
                </li>
                @if(auth()->user() != null && auth()->user()->seviye == 0)
                    <li class="nav-item {{ Request::is('kullanici/paket*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('kullanici.diyetisyen.kayit') }}">
                            <span>Diyetisyen Kaydı</span>
                        </a>
                    </li>
                @endif
            @endauth
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kullanici.giris') }}">Giriş Yap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kullanici.kayit') }}">Kayıt Ol</a>
                </li>
            @endguest
        </ul>
        <form class="form-inline my-2 my-lg-0" action="{{ route('diyetisyen') }}" method="POST">
                {{ csrf_field() }}
                <input class="form-control mr-sm-2" type="text" id="ara" name="ara" placeholder="Diyetisyen ara..." value="{{ old('ara') }}">
                <button class="btn btn-dark my-2 my-sm-0" type="submit">Ara</button>
        </form>
    </div>
</nav>


