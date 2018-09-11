@extends('layouts.master')
@section('title', 'Giriş Yap - Diyetisyen Portalı')

@section('content')

    <div class="container">
        <div class="row mt-5">
            @include('layouts.partials.errors')
            @include('layouts.partials.alert')
            <div class="col-md-6 m-auto">
                <h1 class="display-4 text-center">Giriş Yap</h1>
                <hr class="my-4">
                <form action="{{ route('kullanici.giris') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="email" id="email" class="form-control" placeholder="E-posta...">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="sifre" id="sifre" class="form-control" placeholder="Şifre...">
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <div class="col-md-12">
                            <label for="benihatirla">Beni Hatırla</label>
                            <input type="checkbox" name="benihatirla" checked>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <span class="float-left">
                                <a href="{{ route('kullanici.kayit') }}" class="btn btn-info">Kayıt Ol <i class="fa fa-user"></i></a>
                            </span>
                            <span class="float-right">
                                <button type="submit" class="btn btn-success">Giriş Yap <i class="fas fa-chevron-right"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
                <div class="col-md-12 text-center">

                </div>
            </div>
        </div>
    </div>
@endsection

