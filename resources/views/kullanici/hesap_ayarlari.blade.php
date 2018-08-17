<div class="col-lg-4 teacher">
    <div class="card" >
        <div class="card_img">
            <div class="card_plus trans_200 text-center" style="z-index: 1; width: auto; padding: 0 5px;"><a href="{{ route('kullanici.avatar') }}">avatar yükle</a></div>
            <img class="card-img trans_200" style="height: 300px!important; object-fit: cover" src="/{{ $kullanici->resim->klasor }}/{{ $kullanici->resim->url }}" alt="https://unsplash.com/@michaeldam">
        </div>
        <div class="card-body text-center">
            <div class="card-title">
                <h2 style="color: #3d3d3d">{{ $kullanici->ad_soyad }}</h2>
                <span class="badge badge-warning" style="font-size: 16px">{{ $kullanici->seviye == 0 ? 'Kullanıcı' : 'Diyetisyen' }}</span>
            </div>
            <div class="card-text pt-2">
                <a href="{{ route('kullanici.panel') }}" class="btn btn-primary btn-sm"><i class="fa fa-cog"></i> Hesap Ayarlarım</a>
            </div><div class="card-text pt-4">
                <a href="{{ route('mesaj.alinanlar') }}" class="btn btn-success btn-sm"><i class="fa fa-envelope-open"></i> Mesaj Kutum</a>
            </div>
        </div>
    </div>
</div>