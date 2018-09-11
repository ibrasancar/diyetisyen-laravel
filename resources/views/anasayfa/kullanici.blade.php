@if(auth()->user() != null && auth()->user()->seviye == 0)
    <section class="mt-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <h2>Hoşgeldin {{ auth()->user()->ad_soyad }}</h2>
                    <span>
                        <p class="mb-4">
                            Sağdaki menüden diyetisyenleri görebilir, mesaj atabilir, ayarlarını düzenleyebilirsin ve ayrıca gelen kutunu kontrol edebilirsin.
                        </p>
                        <p class="mb-4">
                            Binlerce diyetisyen bir tık uzağınızda!
                        </p>
                    </span>
                </div>
                <div class="col-md-6 text-center">
                    <span class="mr-4">
                        <a href="{{ route('diyetisyen') }}" class="btn btn-outline-primary btn-lg overflow-hidden position-relative">Diyetisyenler <i class="fa fa-utensils button_icon"></i></a>
                    </span>
                    <span class="mr-4">
                        <a href="{{ route('kullanici.panel') }}" class="btn btn-outline-secondary btn-lg overflow-hidden position-relative">Panelim <i class="fa fa-cog button_icon"></i></a>
                    </span>
                    <span class="">
                        <a href="{{ route('mesaj.alinanlar') }}" class="btn btn-outline-info btn-lg overflow-hidden position-relative">Mesajlar <span class="badge {{ $okunmamis_mesaj_sayisi > 0 ? 'badge-info' : 'display_none' }}">{{ $okunmamis_mesaj_sayisi }}</span> <i class="fa fa-envelope button_icon"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </section>
    <hr class="my-4">
    <section class="mt-5">
        <div class="container">
            <h2 class="text-center">Öneriyoruz</h2>
            <div class="row mt-5">
                @foreach($anasayfa_diyetisyen as $diyetisyen)
                    <div class="col-md-4">
                        <div class="card mb-3 overflow-hidden">
                            <h3 class="card-header"><a href="{{ route('diyetisyen.incele', $diyetisyen->diyetisyen->kullanici->kullanici_adi) }}">{{ $diyetisyen->diyetisyen->kullanici->ad_soyad }}</a></h3>
                            <div class="card-body">
                                <h6 class="card-title">{{ $diyetisyen->diyetisyen->diyetisyen_tip->tanim }} <i class="fas fa-star list_icon" style="color: #FFCE67"></i></h6>
                            </div>
                            <img style="height: 200px; object-fit: cover" src="/{{ $diyetisyen->diyetisyen->kullanici->resim->klasor }}/{{ $diyetisyen->diyetisyen->kullanici->resim->url }}" alt="Card image">
                            <div class="card-body">
                                <p class="card-text">{{ $diyetisyen->diyetisyen->aciklama }}</p>
                            </div>
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item overflow-hidden">
                                    <i class="fas fa-info-circle list_icon"></i>
                                    <strong>Puan:</strong>
                                    <span class="badge badge-info">
                                    @for($i = 1; $i <= $diyetisyen->diyetisyen->puan; $i++)
                                            <i class="fas fa-star" style="color: #fff;"></i>
                                        @endfor
                                        @if($diyetisyen->diyetisyen->puan - floor($diyetisyen->diyetisyen->puan) > 0.0 && $diyetisyen->diyetisyen->puan < 5)
                                            <i class="fas fa-star-half" style="color: #fff"></i>
                                        @endif
                                        </span>
                                </li>
                            </ul>
                            <div class="card-body">
                                    <span class="float-left">
                                        <a href="{{ route('mesaj.yaz', $diyetisyen->diyetisyen->kullanici->kullanici_adi) }}" class="btn btn-sm  btn-outline-primary">Mesaj At <i class="fas fa-envelope"></i></a>
                                    </span>
                                <span class="float-right">
                                        <a href="{{ route('diyetisyen.incele', $diyetisyen->diyetisyen->kullanici->kullanici_adi) }}" class="btn btn-sm  btn-outline-primary">İncele <i class="fas fa-chevron-right"></i></a>
                                    </span>
                            </div>
                            <div class="card-footer text-muted">
                                {{ $diyetisyen->diyetisyen->kullanici->olusturma_tarihi->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </section>
@endif

@section('styles')
    <style>
        .button_icon{
            position: absolute;
            right: -1px;
            top: -1px;
            font-size: 24px;
            transform: rotate(-30deg);
            opacity: 0.4;
        }
        .list_icon{
            position: absolute;
            right: -7px;
            top: -7px;
            font-size: 48px;
            transform: rotate(-40deg);
            opacity: 0.4;
        }
    </style>
@endsection
