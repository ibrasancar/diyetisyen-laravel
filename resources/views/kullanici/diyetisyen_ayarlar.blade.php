@extends('layouts.master')
@section('title', 'Hesap Ayarlarım - Diyetisyen Portalı')

@section('content')
<div class="container mt-5">
    <div class="row">
        @include('layouts.partials.alert')
        @include('layouts.partials.errors')
        @include('kullanici.sol_panel')
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-0">
                    <div class="card-header">
                        <h2 style="color: #3f3f3f">Hesap Ayarları</h2>
                    </div>
                    <div class="card-text p-3 pt-4">
                        <form method="post" action="{{ route('kullanici.diyetisyen_panel') }}" style="width: 100%;">
                            {{ csrf_field() }}
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="tip">Diyetisyen Tipi: * </label>
                                        <select name="tip" id="tip" class="form-control">
                                            @foreach($diyetisyen_tipleri as $item)
                                                <option value="{{ $item->tip }}" {{ $item->tip == $kullanici->diyetisyen->tip ? 'selected' : '' }}>{{ $item->tanim }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="aciklama">Kısa Açıklama: * </label>
                                        <textarea name="aciklama" id="aciklama" rows="3" class="form-control p-3" style="height: 100px">{{ old('aciklama', $kullanici->diyetisyen->aciklama) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="ozgecmis">Özgeçmiş: * </label>
                                        <textarea name="ozgecmis" id="ozgecmis" rows="3" class="form-control p-3" style="height: 200px">{{ old('ozgecmis', $kullanici->diyetisyen->ozgecmis) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-right">
                                    <button type="submit" class="btn btn-success">Kaydet <i class="fas fa-save list_icon_button"></i> </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
