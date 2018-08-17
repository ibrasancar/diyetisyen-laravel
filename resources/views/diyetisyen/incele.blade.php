@extends('layouts.master')
@section('title', $kullanici->ad_soyad . ' - ' . config('app.name'))
@section('content')
    <div class="home">
        <div class="home_background_container prlx_parent">
            <div class="home_background prlx" style="background-image:url(/images/teachers_background.jpg)"></div>
        </div>
        <div class="home_content">
            <h1>{{ $kullanici->ad_soyad }}</h1>
        </div>
    </div>

    <div class="teachers page_section">
        <div class="container">
            <div class="row">

                <!-- Teacher -->
                <div class="col-lg-4 teacher">
                    <div class="card" >
                        <div class="card_img">
                            <img class="card-img" style="height: 300px!important; object-fit: cover" src="/{{ $kullanici->resim->klasor }}/{{ $kullanici->resim->url }}" alt="https://unsplash.com/@michaeldam">
                        </div>
                        <div class="card-body text-center">
                            <div class="card-title"><a href="{{ route('diyetisyen.incele', $kullanici->kullanici_adi) }}">{{ $kullanici->ad_soyad }}</a></div>
                            <div class="card-text">{{ $kullanici->diyetisyen->diyetisyen_tip->tanim }}</div>
                            <div class="teacher_social">
                                <ul class="menu_social">
                                    @foreach($kullanici->sosyal_medya as $item)
                                        <li class="menu_social_item"><a href="{{ $item->deger }}"><i class="fab fa-{{ $item->tip }}"></i></a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="teacher_social">
                                <a href="{{ route('mesaj.yaz', $kullanici->id) }}" class="btn btn-info"><i class="fa fa-envelope-open"></i> Mesaj Gönder</a>
                                <a href="{{ route('diyetisyen.yorum_sayfa', $kullanici->kullanici_adi) }}" class="btn btn-primary"><i class="fa fa-comment"></i> Yorum Yap</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    @include('layouts.partials.alert')
                    @include('layouts.partials.errors')
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="card-header">
                                <h2>Özgeçmiş</h2>
                            </div>
                            <div class="card-text p-4">
                                <p>{{ $kullanici->diyetisyen->ozgecmis }}</p>
                            </div>
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="p-4" style="width: 100%; display: block">
                                            <i class="fa fa-map-marker"></i> {{ $kullanici->adres }}
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="p-4 text-right" style="width: 100%; display: block">
                                            Puan:
                                            @for($i = 1; $i <= $kullanici->diyetisyen->puan; $i++)
                                            <i class="fa fa-star"></i>
                                            @endfor
                                            @if($kullanici->diyetisyen->puan - floor($kullanici->diyetisyen->puan) > 0.0)
                                                <i class="fa fa-star-half"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                    <a href="tel:{{$kullanici->telefon}}" class="btn btn-dark ">
                                        <i class="fa fa-phone"></i> {{$kullanici->telefon}}
                                    </a>
                                    <a href="tel:{{$kullanici->cep_telefon}}" class="btn btn-dark float_right">
                                        <i class="fa fa-phone"></i> {{$kullanici->cep_telefon}}
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 pt-4">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="card-header mb-4">
                                <h2>Yorumlar</h2>
                            </div>
                            <div class="card-text pl-4 pr-4 pb-2">
                                @if(count($alinan_yorumlar) <= 0)
                                    <div class="row">
                                        <div class="col-md-12 text-center pb-2">
                                            <a href="{{ route('diyetisyen.yorum_sayfa', $kullanici->kullanici_adi) }}">Bu kullanıcıya ilk yorumu sen yap!</a>
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($kullanici_yorumu))
                                    <div style="background: #eff3f3; padding: 10px 20px">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="pb-1" style="border-bottom: 2px solid #dddddd;">Yorumum:</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <span style=""><i class="fa fa-user"></i> {{ $kullanici_yorumu->kullanici->ad_soyad }}</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <span style=""> <i class="fa fa-clock"></i> {{ $kullanici_yorumu->gonderme_tarihi->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="pt-2">{{ $kullanici_yorumu->yorum }}</p>
                                                <span class="text-right pb-4">
                                    @for($i = 0; $i < $kullanici_yorumu->puan; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                            </span>
                                            </div>
                                            <div class="col-md-6 text-right pt-4">
                                                <a href="" class="btn btn-primary btn-sm">Düzenle <i class="fa fa-pencil-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="pb-2"/>
                                    @endif
                                @foreach($alinan_yorumlar as $item)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span style=""><i class="fa fa-user"></i> {{ $item->kullanici->ad_soyad }}</span>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <span style=""> <i class="fa fa-clock"></i> {{ $item->gonderme_tarihi->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <p class="pt-2">{{ $item->yorum }}</p>
                                    <span class="text-right pb-4">
                                        @for($i = 0; $i < $item->puan; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    </span>
                                        @if($loop->last != true)
                                            <hr/>
                                        @endif
                                @endforeach
                            </div>
                            <div class="card-footer text-center" style="display: flex; justify-content: center;">
                                {{ $alinan_yorumlar->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/plugins/easing/easing.js"></script>
    <script src="/js/teachers_custom.js"></script>
@endpush

@section('style')
    <link rel="stylesheet" type="text/css" href="/styles/teachers_styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/teachers_responsive.css">
@endsection