@extends('layouts.master')
@section('title', 'Hesap Ayarlarım - Diyetisyen Portalı')

@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('layouts.partials.alert')
            @include('layouts.partials.errors')
            <div class="col-md-12">
                <h2 class="h2">
                    Ödeme Sonucu
                </h2>
                <hr class="my-4"/>
            </div>

            <div class="col-md-12">
                <h3>
                    <span class="badge badge-{{ $checkoutForm->getPaymentStatus() == "SUCCESS" ? 'success' : 'danger' }}">
                        {{ $checkoutForm->getPaymentStatus() == "SUCCESS" ? 'Ödeme Başarılı' : 'Ödeme Yapılamadı' }}
                    </span>
                </h3>

            </div>

        </div>
    </div>
@endsection

@push('scripts')


@endpush