@extends('layouts.master')
@section('title', 'Mesaj Kutum - Diyetisyen Portalı')

@section('content')
    <div class="container mt-5" style="">
        @include('layouts.partials.alert')
        @include('layouts.partials.errors')
        <div class="row">
            @include('kullanici.sol_panel')
            <div class="col-lg-8">
                <div class="card border-primary">
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
                                        <th>{{ Request::is('mesaj/giden') ? 'Alıcı' : 'Gönderen'}}</th>
                                        <th>Başlık</th>
                                        <th>Gönderme Tarihi</th>
                                        <th>İşlemler</th>
                                    </thead>
                                    @include('kullanici.mesaj.layouts.bos_mesaj_kutusu')

                                    @php
                                        $sayfa = isset($_GET['page']) ? $_GET['page'] : 1;
                                        if($sayfa == 1 )
                                        {
                                            $mesaj_sayisi = $mesajlar->total() + 1;
                                        }
                                        else
                                        {
                                            $mesaj_sayisi = ($mesajlar->total() + 1)  - (($sayfa-1) * 6);
                                        }
                                    @endphp

                                    @foreach($mesajlar as $itemKey => $item)
                                        <tr style="{{ $item->okunma_tarihi == null ? '' : 'opacity:0.5;' }}">
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $mesaj_sayisi -= 1 }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">
                                                    @if(Request::is('mesaj/giden'))
                                                        {{ $item->alici_bilgileri->ad_soyad }}
                                                    @else
                                                        {{ $item->gonderici_bilgileri->ad_soyad }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{ $item->baslik }}</td>
                                            <td>{{ $item->gonderme_tarihi->diffForHumans() }}</td>
                                            <td><a href="{{ route('mesaj.incele', $item->id) }}" class="btn {{ $item->okunma_tarihi == null ? 'btn-info' : 'btn-outline-info' }} btn-sm">İncele <i class="fa fa-search fa-xs ml-1"></i></a> </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="text-right">
                                            <a href="{{ route($mesaj_tur) }}" class="btn btn-primary">{{ $mesaj_text }} <i class="fas fa-chevron-right"></i></a>
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
@endsection
