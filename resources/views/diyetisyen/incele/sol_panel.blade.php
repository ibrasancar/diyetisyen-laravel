<div class="col-md-4">
    <div class="card mb-3">
        <img style="height: 300px; object-fit: cover" src="/{{ $kullanici->resim->klasor }}/{{ $kullanici->resim->url }}" alt="Card image">
        <div class="card-body">
            <p class="card-text">{{ $kullanici->diyetisyen->aciklama }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item overflow-hidden">
                <i class="fas fa-map list_icon"></i> <p style="z-index: 2;">{{ $kullanici->adres }}</p>
            </li>
            <li class="list-group-item overflow-hidden">
                <i class="fas fa-info-circle list_icon"></i>
                <strong>Puan:</strong>
                <span class="badge badge-info" style="z-index: 2">
                    @if($kullanici->diyetisyen->puan == null || $kullanici->diyetisyen->puan == 0)
                        <i class="fas fa-frown fa-2x" style="color: #fff;">
                        </i>
                    @endif
                    @for($i = 1; $i <= $kullanici->diyetisyen->puan; $i++)
                        <i class="fas fa-star" style="color: #fff;"></i>
                    @endfor
                    @if($kullanici->diyetisyen->puan - floor($kullanici->diyetisyen->puan) > 0.0 && $kullanici->diyetisyen->puan < 5)
                        <i class="fas fa-star-half" style="color: #fff"></i>
                    @endif
                </span>
            </li>
            @if($kullanici->sosyal_medya != null)
                <li class="list-group-item overflow-hidden text-center">
                    <i class="fas fa-share-square list_icon"></i>
                    @foreach($kullanici->sosyal_medya as $item)
                        <a href="{{ $item->deger }}">
                            <i class="fab fa-{{$item->tip}} fa-2x mr-2"></i>
                        </a>
                    @endforeach
                </li>
            @endif
        </ul>

        <div class="card-footer text-muted">
            <span class="float-left">
                <small>Kayıt Tarihi: {{ $kullanici->olusturma_tarihi->diffForHumans() }}</small>
            </span>
            <span class="float-right">
                <a href="{{ route('diyetisyen.yorum_sayfa', $kullanici->kullanici_adi) }}" class="btn btn-sm btn-outline-primary" style="position: relative; right: 0;">Yorum Yap <i class="fas fa-comment"></i></a>
            </span>
        </div>
    </div>

</div>

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
    </style>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="/js/themes/fontawesome-stars.css">
    <style>
        .br-theme-fontawesome-stars{
            float: right;
        }
    </style>
@endsection