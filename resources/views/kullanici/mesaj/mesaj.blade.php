@extends('layouts.master')
@section('title', 'Mesaj Kutum - Diyetisyen Portalı')

@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_background_container prlx_parent">
            <div class="home_background prlx" style="background-image:url(/images/teachers_background.jpg)"></div>
        </div>
        <div class="home_content">
            <h1>Mesaj Kutum</h1>
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
                                <h2 style="color: #3f3f3f">Mesaj Kutum</h2>
                            </div>
                        </div>
                        <div class="card-text p-3 pt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>Gönderici</th>
                                            <th>Alıcı</th>
                                            <th>Başlık</th>
                                            <th>Gönderme Tarihi</th>
                                            <th>İşlemler</th>
                                        </thead>
                                        @if(count($mesajlar) <= 0)
                                            <tr>
                                                <td colspan="6">
                                                    <span style="font-size: 1.5em">Mesaj kutunuz boş.</span>
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach($mesajlar as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->gonderici_id }}</td>
                                                <td>{{ $item->alici_id }}</td>
                                                <td>{{ $item->baslik }}</td>
                                                <td>{{ $item->gonderme_tarihi }}</td>
                                                <td><a href="{{ route('mesaj.incele', $item->id) }}" class="btn btn-info btn-sm">İncele</a> </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6" class="text-right">
                                                <a href="{{ route($mesaj_tur) }}" class="btn btn-primary">{{ $mesaj_text }}</a>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ $mesajlar->links() }}
                                        </div>
                                    </div>
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