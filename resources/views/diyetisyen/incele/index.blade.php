@extends('layouts.master')
@section('title', $kullanici->ad_soyad . ' - ' . config('app.name'))
@section('content')
        <div class="container">
            <div class="row mt-5">

                <!-- Teacher -->
                @include('diyetisyen.incele.sol_panel')

                <div class="col-lg-8">

                    @include('layouts.partials.alert')
                    @include('layouts.partials.errors')
                    <div class="jumbotron">
                        <h3 class="display-5">{{ $kullanici->ad_soyad }}</h3>
                        <p class="lead">{{ $kullanici->diyetisyen->diyetisyen_tip->tanim }}</p>
                        <hr class="my-4">
                        <p>{!! $kullanici->diyetisyen->ozgecmis !!}</p>
                        <p class="lead text-center mt-5">
                            <a class="btn btn-primary btn-lg" href="{{ route('mesaj.yaz', $kullanici->id) }}" role="button">Soru Sor <i class="fas fa-question"></i></a>
                        </p>
                    </div>
                </div>

                @include('diyetisyen.incele.yorumlar')

            </div>
        </div>
@endsection
