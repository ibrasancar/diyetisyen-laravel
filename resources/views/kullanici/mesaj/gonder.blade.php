@extends('layouts.master')
@section('title', 'Gelen Mesaj - Diyetisyen Portalı')

@section('content')
    <!-- Home -->
    <div class="home">
        <div class="home_background_container prlx_parent">
            <div class="home_background prlx" style="background-image:url(/images/teachers_background.jpg)"></div>
        </div>
        <div class="home_content">
            <h1>Mesaj Gönder</h1>
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
                                <h2 style="color: #3f3f3f">Başlık: </h2>
                            </div>
                        </div>
                        <div class="card-text p-3 pt-4">
                            <div class="row">
                                <div class="col-md-12">

                                    <form action="{{ route('mesaj.gonder') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="alici">Alıcı:</label>
                                                <input type="textarea" id="alici" name="alici" class="form-control" value="{{ $alici->ad_soyad }}" readonly>
                                                <input type="hidden" name="alici_id" id="alici_id" value="{{ $alici->id }}">
                                                <input type="hidden" name="mesaj_id" id="mesaj_id" value="{{ isset($onceki_mesaj) ? $onceki_mesaj->id : '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="alici">Başlık:</label>
                                                <input type="text" id="baslik" name="baslik" class="form-control" value="{{ isset($onceki_mesaj) ? 'Cevap: ' . $onceki_mesaj->baslik : ''}}">

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="mesaj"></label>
                                                <textarea name="mesaj" id="mesaj" cols="30" rows="10" class="form-control">
                                                        {{ isset($onceki_mesaj) ? '<blockquote>' . $onceki_mesaj->mesaj . '</blockquote>' : '' }}
                                                        <p>
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label for="dosya_ek">Ek:</label>
                                                <input type="file" id="dosya_ek" name="dosya_ek" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 mt-2 text-right">
                                                <button type="submit" href="" class="btn btn-sm btn-success" style="cursor: pointer">Cevapla <i class="fa fa-arrow-right"></i></button>
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
    </div>
@endsection

@push('scripts')
    <script src="/plugins/easing/easing.js"></script>
    <script src="/js/teachers_custom.js"></script>
    <script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace("mesaj");
    </script>
@endpush

@section('style')
    <link rel="stylesheet" type="text/css" href="/styles/teachers_styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/teachers_responsive.css">
@endsection