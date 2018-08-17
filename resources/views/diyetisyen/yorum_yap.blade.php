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
                                <a href="" class="btn btn-primary"><i class="fa fa-comment"></i> Yorum Yap</a>
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
                                <h2>Yorum Yap</h2>
                            </div>
                            <div class="card-text">
                                <form action="{{ route('diyetisyen.yorum_sayfa', $kullanici->kullanici_adi) }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row p-4">
                                        <div class="col-md-12">
                                            <textarea name="yorum" id="yorum" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="col-md-12 pt-2 pb-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-success" style="cursor:pointer;">Gönder <i class="fa fa-chevron-right" ></i></button>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="rating" style="position: absolute; right: 0;">
                                                      <input id="puan_5" type="radio" name="puan" value="5">
                                                      <label for="puan_5">5</label>
                                                      <input id="puan_4" type="radio" name="puan" value="4">
                                                      <label for="puan_4">4</label>
                                                      <input id="puan_3" type="radio" name="puan" value="3" checked>
                                                      <label for="puan_3">3</label>
                                                      <input id="puan_2" type="radio" name="puan" value="2">
                                                      <label for="puan_2">2</label>
                                                      <input id="puan_1" type="radio" name="puan" value="1">
                                                      <label for="puan_1">1</label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
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
    <style>
        .rating {
            overflow: hidden;
            vertical-align: bottom;
            display: inline-block;
            width: auto;
            height: 30px;
        }

        .rating > input {
            opacity: 0;
            margin-right: -100%;
        }

        .rating > label {
            position: relative;
            display: block;
            float: right;
            background: url('/images/star-off-big.png');
            background-size: 30px 30px;
        }

        .rating > label:before {
            display: block;
            opacity: 0;
            content: '';
            width: 30px;
            height: 30px;
            background: url('/images/star-on-big.png');
            background-size: 30px 30px;
            transition: opacity 0.2s linear;
        }

        .rating > label:hover:before,  .rating > label:hover ~ label:before,  .rating:not(:hover) > :checked ~ label:before { opacity: 1; }
    </style>
@endsection