@extends('layouts.master')
@section('title', 'Avatar Yükle - Diyetisyen Portalı')

@section('content')
        <div class="container mt-5">
            @include('layouts.partials.alert')
            @include('layouts.partials.errors')
            <div class="row">
                @include('kullanici.sol_panel')
                <div class="col-lg-8">
                    <div class="card border-primary">
                        <div class="card-body p-0">
                            <div class="card-header">
                                <h2>Avatar Ayarları</h2>
                            </div>
                            <div class="card-text p-3 pt-4">
                                <form method="post" action="{{ route('kullanici.avatar') }}" style="width: 100%;" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="file" name="avatar" id="avatar" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-success">Yükle <i class="fas fa-upload list_icon_button"></i></button>
                                            </div>
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
    <script src="/plugins/easing/easing.js"></script>
    <script src="/js/teachers_custom.js"></script>
@endpush

@section('style')
    <link rel="stylesheet" type="text/css" href="/styles/teachers_styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/teachers_responsive.css">
@endsection