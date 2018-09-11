<div class="col-lg-12 pt-4">
    <div class="card mb-5">
        <div class="card-body p-0">
            <div class="card-header mb-4">
                <h2>Yorumlar</h2>
            </div>
            <div class="card-text">
                @if(count($alinan_yorumlar) <= 0)
                    <div class="row">
                        <div class="col-md-12 text-center pb-2">
                            <a href="{{ route('diyetisyen.yorum_sayfa', $kullanici->kullanici_adi) }}">Bu diyetisyene ilk yorumu sen yap!</a>
                        </div>
                    </div>
                @endif
                @if(!empty($kullanici_yorumu))
                    <div style="background: #f5f6fa; padding: 20px 30px;" class="overflow-hidden position-relative">
                        <div class="row">
                            <i class="fas fa-user-circle list_icon"></i>
                            <div class="col-md-12">
                                <h3 class="pb-1" style="border-bottom: 2px solid #dddddd;">Yorumum:</h3>
                            </div>
                            <div class="col-md-6">
                                <span style=""><i class="fa fa-user"></i> {{ $kullanici_yorumu->kullanici->ad_soyad }}</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <span style=""> <i class="fa fa-clock"></i> {{ $kullanici_yorumu->gonderme_tarihi->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="pt-2">{{ $kullanici_yorumu->yorum }}</p>
                                <span class="text-right pb-4">
                                                    @for($i = 0; $i < $kullanici_yorumu->puan; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                            </span>
                            </div>

                        </div>
                    </div>
                    <hr class="pb-2"/>
                @endif
                @foreach($alinan_yorumlar as $item)
                    <div class="span pl-4 pr-4 pb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <span style=""><i class="fa fa-user"></i> {{ $item->kullanici->ad_soyad }}</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <span style=""> <i class="fa fa-clock"></i> {{ $item->gonderme_tarihi->diffForHumans() }}</span>
                            </div>
                        </div>
                        <p class="pt-2">{{ $item->yorum }}</p>
                        <span class="text-right pb-4">
                                        @for($i = 0; $i < $item->puan; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                                    </span>
                        @if($loop->last != true)
                            <hr/>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="card-footer text-center" style="display: flex; justify-content: center;">
                {{ $alinan_yorumlar->links() }}
            </div>
        </div>
    </div>
</div>