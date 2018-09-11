@extends('layouts.master')
@section('title', 'Hesap Ayarlarım - Diyetisyen Portalı')

@section('content')
<div class="container mt-5">
    <div class="row">
        @include('layouts.partials.alert')
        @include('layouts.partials.errors')

        @include('kullanici.sol_panel')

        <div class="col-lg-8">
            <div class="card border-primary">
                <div class="card-body p-0">
                    <div class="card-header">
                        <h2>Hesap Ayarları</h2>
                    </div>
                    <div class="card-text p-3 pt-4">
                        <form method="post" action="{{ route('kullanici.panel') }}" style="width: 100%;">
                            {{ csrf_field() }}
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ad_soyad">Ad Soyad: * </label>
                                        <input type="text" name="ad_soyad" id="ad_soyad" class="form-control" placeholder="Adınız soyadınız..." value="{{ old('ad_soyad') ? old('ad_soyad') : $kullanici->ad_soyad }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="kullanici_adi">Kullanıcı Adı: * </label>
                                        <input type="hidden" name="original_kullanici_adi" value="{{ old('kullanici_adi', $kullanici->kullanici_adi) }}">
                                        <input type="text" name="kullanici_adi" id="kullanici_adi" class="form-control" placeholder="Kullanıcı adınız..." value="{{ old('kullanici_adi', $kullanici->kullanici_adi) }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">E-Mail: * </label>
                                        <input type="hidden" name="original_email" value="{{ old('email', $kullanici->email) }}">

                                        <input type="text" name="email" id="email" class="form-control" placeholder="E-mail..." value="{{ old('email', $kullanici->email) }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="telefon">Telefon: </label>
                                        <input type="text" name="telefon" id="telefon" class="form-control" placeholder="Lütfen sabit hat numaranızı giriniz..." value="{{ old('telefon', $kullanici->telefon) }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="cep_telefon">Cep Telefon: * </label>
                                        <input type="text" name="cep_telefon" id="cep_telefon" class="form-control" placeholder="Cep telefonu..." value="{{ old('cep_telefon', $kullanici->cep_telefon) }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tc_no">TC Numarası: * </label>
                                        <input type="text" name="tc_no" id="tc_no" class="form-control" placeholder="Cep telefonu..." value="{{ old('tc_no', $kullanici->tc_no) }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="dogum_tarihi">Doğum Tarihi: * </label>
                                        <input type="date" name="dogum_tarihi" id="dogum_tarihi" class="form-control" placeholder="Doğum tarihi..." value="{{ old('dogum_tarihi', $kullanici->dogum_tarihi) }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="sifre">Şifre: * </label>
                                        <input type="password" name="sifre" id="sifre" class="form-control" placeholder="Şifre...">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="sifre_confirmation">Şifre Onayı: * </label>
                                        <input type="password" name="sifre_confirmation" id="sifre_confirmation" class="form-control" placeholder="Şifre onayı...">
                                    </div>
                                </div>


                                @for($i = 0; $i < 3; $i++)
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="{{ $kullanici->sosyal_medya[$i]->tip }}">{{ ucfirst($kullanici->sosyal_medya[$i]->tip) }}: </label>
                                            <input type="text" id="{{ $kullanici->sosyal_medya[$i]->tip }}" name="{{ $kullanici->sosyal_medya[$i]->tip }}" class="form-control" placeholder="{{ ucfirst($kullanici->sosyal_medya[$i]->tip) }} hesabınızın tam linki..." value="{{ old($kullanici->sosyal_medya[$i]->tip, $kullanici->sosyal_medya[$i]->deger)  }}">
                                        </div>
                                    </div>
                                @endfor

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="adres">Adres: * </label>
                                        <textarea name="adres" id="adres" rows="3" class="form-control p-3" style="height: 100px">{{ old('adres') ? old('adres') : $kullanici->adres }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-right">
                                    <button type="submit" class="btn btn-success">Kaydet <i class="fas fa-save list_icon_button"></i></button>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('#telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
        $('#cep_telefon').mask('+00 (000) 000-00-00', { placeholder: "(___) ___-__-__" });
        $('#tc_no').mask('00000000000', { placeholder: "___________" });
    </script>
@endpush