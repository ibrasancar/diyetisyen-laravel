@extends('layouts.master')
@section('title', 'Gelen Mesaj - Diyetisyen Portalı')

@section('content')
    <!-- Home -->
    <div class="home">
        <div class="home_background_container prlx_parent">
            <div class="home_background prlx" style="background-image:url(/images/teachers_background.jpg)"></div>
        </div>
        <div class="home_content">
            <h1>Mesaj İncele</h1>
        </div>
    </div>
    <div class="teachers page_section">
        <div class="container">
            @include('layouts.partials.alert')
            @include('layouts.partials.errors')
            <div class="row">
                @include('kullanici.hesap_ayarlari')
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="card-header">
                                <h2 style="color: #3f3f3f">Başlık: <em>{{ $mesaj->baslik }} </em></h2>
                            </div>
                        </div>
                        <div class="card-text p-3 pt-4">
                            <div class="row">
                                <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                            <th class="text-left"><i class="fa fa-user"></i> Gönderen: {{ $mesaj->gonderici_bilgileri->ad_soyad }}</th>
                                            <th class="text-right"><i class="fa fa-calendar"></i> Gönderme Tarihi: {{ $mesaj->gonderme_tarihi }}</th>
                                            </thead>
                                            <tr>
                                                <td colspan="2">{!! $mesaj->mesaj !!}</td>
                                            </tr>

                                            <tr>
                                                <td class="text-left">
                                                    <form action="{{ route('mesaj.sil')}}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="mesaj_id" id="mesaj_id" value="{{ $mesaj->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</button>
                                                    </form>
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('mesaj.yaz', [$mesaj->gonderici_id, $mesaj->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> Cevapla</a>
                                                </td>
                                            </tr>
                                        </table>
                                </div>
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