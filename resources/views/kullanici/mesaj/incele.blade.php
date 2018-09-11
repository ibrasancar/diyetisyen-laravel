@extends('layouts.master')
@section('title', 'Gelen Mesaj - Diyetisyen Portalı')

@section('content')
        <div class="container mt-5">
            @include('layouts.partials.alert')
            @include('layouts.partials.errors')
            <div class="row">
                @include('kullanici.sol_panel')
                    <div class="col-md-8">
                        <div class="card border-primary mb-3" >
                            <div class="card-header">
                                <span class="float-left">
                                    Gönderen: <strong>{{ $mesaj->gonderici_bilgileri->ad_soyad }}</strong>
                                </span>
                                <span class="float-right">
                                    {{ $mesaj->gonderme_tarihi->diffForHumans() }}
                                </span>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $mesaj->baslik }}</h4>
                                <p class="card-text">
                                    {!! $mesaj->mesaj !!}
                                </p>
                                @if($mesaj->dosya != null)
                                    <p class="card-text">
                                        <a href="/{{ $mesaj->dosya->klasor }}/{{ $mesaj->dosya->url }}" class="btn btn-info">Mesaj Eki</a>
                                    </p>
                                @endif

                                <form action="{{ route('mesaj.sil') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="mesaj_id" name="mesaj_id" value="{{ $mesaj->id }}">
                                    <button type="submit" class="btn btn-danger float-left">
                                        <i class="fas fa-trash"></i> Sil
                                    </button>
                                </form>

                                <a href="{{ route('mesaj.yaz', $mesaj->gonderici_id, $mesaj->id) }}" class="btn btn-primary float-right">
                                     Cevapla <i class="fas fa-chevron-right"></i>
                                </a>
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