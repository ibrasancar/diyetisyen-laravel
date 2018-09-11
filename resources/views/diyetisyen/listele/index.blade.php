@extends('layouts.master')
@section('title', 'Diyetisyenler - Diyetisyen Portalı')

@section('content')
    <div class="container">
        <div class="row mt-5">

            @include('diyetisyen.listele.sol')

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <span class="float-left">
                            <h2>Diyetisyenler</h2>
                        </span>
                        <span class="float-right">
                            {{ $diyetisyenler->links() }}
                        </span>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row">
                    @foreach($diyetisyenler as $diyetisyen)
                        <div class="col-md-6 custom_col">
                            <div class="card mb-3 overflow-hidden">
                                <h3 class="card-header"><a href="{{ route('diyetisyen.incele', $diyetisyen->kullanici_adi) }}">{{ $diyetisyen->ad_soyad }}</a></h3>
                                <div class="card-body">
                                    <h6 class="card-title">{{ $diyetisyen->diyetisyen_tip->tanim }} <i class="fas fa-user-circle list_icon"></i></h6>
                                </div>
                                <img style="height: 200px; object-fit: cover" src="/{{ $diyetisyen->kullanici->resim->klasor }}/{{ $diyetisyen->kullanici->resim->url }}" alt="Card image">
                                <div class="card-body">
                                    <p class="card-text">{{ $diyetisyen->aciklama }}</p>
                                </div>
                                <ul class="list-group list-group-flush">

                                    <li class="list-group-item overflow-hidden">
                                        <i class="fas fa-info-circle list_icon"></i>
                                        <strong>Puan:</strong>
                                        <span class="badge badge-info">
                                            @for($i = 1; $i <= $diyetisyen->puan; $i++)
                                                <i class="fas fa-star" style="color: #fff;"></i>
                                            @endfor
                                            @if($diyetisyen->puan - floor($diyetisyen->puan) > 0.0 && $diyetisyen->puan < 5)
                                                <i class="fas fa-star-half" style="color: #fff"></i>
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <span class="float-left">
                                        <a href="{{ route('mesaj.yaz', $diyetisyen->id) }}" class="btn btn-sm  btn-outline-primary">Mesaj At <i class="fas fa-envelope"></i></a>
                                    </span>
                                    <span class="float-right">
                                        <a href="{{ route('diyetisyen.incele', $diyetisyen->kullanici_adi) }}" class="btn btn-sm  btn-outline-primary">İncele <i class="fas fa-chevron-right"></i></a>
                                    </span>
                                </div>
                                <div class="card-footer text-muted">
                                    {{ $diyetisyen->kullanici->olusturma_tarihi->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-12 ">
                            <span class="float-right">
                                {{ $diyetisyenler->links() }}
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .list_icon{
            position: absolute;
            right: -7px;
            top: -7px;
            font-size: 48px;
            transform: rotate(-40deg);
            opacity: 0.4;
        }

        .col-md-6.custom_col {
            display: flex;
        }
    </style>
@endsection
