@extends('layouts.master')
@section('title', 'Giriş Yap - Diyetisyen Portalı')

@section('content')
    <div class="home">
        <div class="home_background_container prlx_parent">
            <div class="home_background prlx" style="background-image:url(/images/search_background.jpg)"></div>
        </div>
        <div class="home_content">
            <h1>Giriş Yap</h1>
        </div>
    </div>


    <div class="teachers page_section">
        <div class="container">
            @include('layouts.partials.errors')
            <div class="col-md-6 m-auto">
                <form action="{{ route('kullanici.giris') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="email" id="email" class="form-control mb-4" placeholder="E-posta...">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="sifre" id="sifre" class="form-control mb-4" placeholder="Şifre...">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="benihatirla">Beni Hatırla</label>
                            <input type="checkbox" name="benihatirla" checked>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-right">Giriş Yap</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('kullanici.kayit') }}" class="btn btn-info" style="position: relative; bottom:20px; left:14px">Kayıt Ol</a>
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