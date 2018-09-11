@extends('layouts.master')
@section('title', 'Gelen Mesaj - Diyetisyen Portalı')

@section('content')
        <div class="container mt-5">
            @include('layouts.partials.alert')
            @include('layouts.partials.errors')
            <div class="row">
                @include('kullanici.sol_panel')
                <div class="col-lg-8 mb-5">
                    <div class="card border-primary">
                        <div class="card-body p-0">
                            <div class="card-header">
                                <h2 style="color: #3f3f3f">Mesaj {{ isset($onceki_mesaj) ? 'Cevapla' :  'Gönder' }}</h2>
                            </div>
                        </div>
                        <div class="card-text p-3 pt-4">
                            <div class="row">
                                <div class="col-md-12">

                                    <form action="{{ route('mesaj.gonder') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="alici">Alıcı:</label>
                                                <input type="textarea" id="alici" name="alici" class="form-control" value="{{ $alici->ad_soyad }}" readonly>
                                                <input type="hidden" name="alici_id" id="alici_id" value="{{ $alici->id }}">
                                                <input type="hidden" name="mesaj_id" id="mesaj_id" value="{{ isset($onceki_mesaj) ? $onceki_mesaj->id : '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="alici">Başlık:</label>
                                                <input type="text" id="baslik" name="baslik" class="form-control" value="{{ isset($onceki_mesaj) ? 'Cevap: ' . $onceki_mesaj->baslik : ''}}">

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="mesaj"></label>
                                                @if(isset($onceki_mesaj))
                                                    <div class="row mt-2 mb-4">
                                                        <div class="col-md-12">
                                                            <div class="card border-primary overflow-hidden">
                                                                <div class="card-body">
                                                                    <i class="fas fa-quote-right list_icon"></i>
                                                                    <h4 class="card-title">{{ $onceki_mesaj->baslik }}</h4>
                                                                    <p class="card-text">{!! $onceki_mesaj->mesaj !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <textarea name="mesaj" id="mesaj" cols="30" rows="20" class="form-control">

                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label for="dosya_ek">Ek:</label>
                                                <input type="file" id="dosya_ek" name="dosya_ek" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 mt-2 text-right">
                                                <button type="submit" href="" class="btn btn-sm btn-success" style="cursor: pointer">Cevapla <i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection

@push('scripts')


    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


    <script>
        var quill = new Quill('#mesaj', {
            theme: 'snow'
        });
    </script>


    {{--<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>--}}
    {{--<script type="text/javascript">--}}
        {{--CKEDITOR.replace("mesaj");--}}
    {{--</script>--}}
@endpush

@section('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .list_icon{
            position: absolute;
            right: -5px;
            top: -5px;
            font-size: 72px;
            transform: rotate(-20deg);
            opacity: 0.4;
        }
    </style>
@endsection