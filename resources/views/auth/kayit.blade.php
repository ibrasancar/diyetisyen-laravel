@extends('layouts.master')
@section('title', 'Kayıt Ol - Diyetisyen Portalı')

@section('content')
    <div class="container mt-5">
        @include('layouts.partials.errors')
        <div class="col-md-8 m-auto">
            <h2 class="h2 display-4 text-center">Kayıt Formu</h2>
            <hr class="my-4"/>

            <form action="{{ route('kullanici.kayit') }}" method="post" role="form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="E-posta hesabınızı giriniz." value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="password" name="sifre" id="sifre" class="form-control" placeholder="Şifre...">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="password" name="sifre_confirmation" id="sifre_confirmation" class="form-control" placeholder="Şifre onayı...">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="kullanici_adi" id="kullanici_adi" class="form-control" placeholder="Kullanıcı adınızı giriniz." value="{{ old('kullanici_adi') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="ad_soyad" id="ad_soyad" class="form-control" placeholder="Adınız ve soyadınızı giriniz." value="{{ old('kullanici_adi') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="telefon" id="telefon" class="form-control" placeholder="Telefon numaranızı giriniz..." value="{{ old('telefon') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="cep_telefon" id="cep_telefon" class="form-control" placeholder="Cep telefon numaranızı giriniz..." value="{{ old('cep_telefon') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="tc_no" id="tc_no" class="form-control" placeholder="TC Kimlik numaranızı giriniz" value="{{ old('tc_no') }}">
                            <small>Kayıt için gereklidir.</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="date" name="dogum_tarihi" id="dogum_tarihi" class="form-control" value="{{ old('dogum_tarihi') }}">
                            <small>Doğum tarihi</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="adres" id="adres" class="form-control p-3" style="height: 150px" placeholder="Adresinizi giriniz...">{{ old('adres') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-success">Kayıt Ol <i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/plugins/easing/easing.js"></script>
    <script src="/js/teachers_custom.js"></script>
    <script src="/js/contact_custom.js"></script>
    <script src="/js/elements_custom.js"></script>
@endpush

@section('style')
    <link rel="stylesheet" type="text/css" href="/styles/teachers_styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/teachers_responsive.css">
    <link rel="stylesheet" type="text/css" href="/styles/contact_styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/elements_styles.css">
@endsection