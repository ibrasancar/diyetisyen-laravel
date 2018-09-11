@if(auth()->user() != null && auth()->user()->seviye == 1)
    <section class="mt-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <h2>Hoşgeldin {{ auth()->user()->ad_soyad }}</h2>
                    <span>
                        <p class="mb-4">
                            Sağdaki menüden, ayarlarını düzenleyebilirsin ve ayrıca gelen kutunu kontrol edebilirsin.
                        </p>
                        <p class="mb-4">
                            Eğer diyetisyenseniz kayıt olup müşterilere ulaşabilirsiniz!
                        </p>
                    </span>
                </div>
                <div class="col-md-6 text-center">
                    <span class="mr-4">
                        <a href="{{ route('kullanici.diyetisyen_panel') }}" class="btn btn-outline-primary btn-lg">Diyetisyen Paneli</a>
                    </span>
                    <span class="mr-4">
                        <a href="{{ route('kullanici.panel') }}" class="btn btn-outline-secondary btn-lg">Panelim</a>
                    </span>
                    <span class="">
                        <a href="{{ route('mesaj.alinanlar') }}" class="btn btn-outline-info btn-lg">Mesajlar <span class="badge {{ $okunmamis_mesaj_sayisi > 0 ? 'badge-info' : 'badge-danger' }}">{{ $okunmamis_mesaj_sayisi }}</span></a>
                    </span>
                </div>
            </div>
        </div>
    </section>
@endif