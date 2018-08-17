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
                            <div class="card-title"><a href="#">{{ $kullanici->ad_soyad }}</a></div>
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
                                <a href="" class="btn btn-primary"><i class="fa fa-comment"></i> Yorum Yap</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
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