<div class="col-lg-4">
    <div class="card" >
        <div class="card_img">
            <a href="{{ route('kullanici.avatar') }}" class="show_link">
                <img class="card-img" style="height: 300px!important; object-fit: cover" src="/{{ $kullanici->resim->klasor }}/{{ $kullanici->resim->url }}">
            </a>
        </div>

        <div class="card-body text-center">

            <div class="card-title">
                <h2 style="color: #3d3d3d">{{ $kullanici->ad_soyad }}</h2>
                <span class="badge badge-warning" style="font-size: 16px">{{ $kullanici->seviye == 0 ? 'Kullanıcı' : 'Diyetisyen' }}</span>
            </div>

            <div class="card-text pt-2">
                <a href="{{ route('kullanici.panel') }}" class="btn btn-primary link_btn" style="width: 66%">
                    <i class="fa fa-user-cog list_icon_button"></i> Hesap Ayarı
                </a>

                <a href="{{ route('kullanici.avatar') }}" class="btn btn-danger mt-2 link_btn" style="width: 66%"><i class="fas fa-image list_icon_button"></i> Avatar Yükle</a>

                @if($kullanici->seviye == 1)
                    <a href="{{ route('kullanici.diyetisyen_panel') }}" class="btn btn-success mt-2 link_btn" style="width: 66%">
                        <i class="fa fa-cog list_icon_button"></i> Abonelik Ayarı
                    </a>
                @endif
                <a href="{{ route('mesaj.alinanlar') }}" class="btn btn-info mt-2 link_btn" style="width: 66%">
                    <i class="fa fa-envelope-open list_icon_button"></i> Mesaj Kutusu
                </a>
            </div>
        </div>

    </div>
</div>