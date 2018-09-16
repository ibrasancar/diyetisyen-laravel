@extends('layouts.master')
@section('title', 'Hesap Ayarlarım - Diyetisyen Portalı')

@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('layouts.partials.alert')
            @include('layouts.partials.errors')
            <div class="col-md-12">
                <h2 class="h2">
                    Seçtiğiniz Paket: <span class="badge badge-primary">{{ $paket->tanim }} - {{ $paket->ucret }} ₺</span>
                </h2>
                <p class="lead">
                    {{ $paket->icerik }}
                </p>
                <hr class="my-4"/>
            </div>

                {{--<div class="col-md-12">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-body">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<h4>Diyetisyen Bilgileri</h4>--}}
                                    {{--<hr class="my-4"/>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6">--}}

                                    {{--<textarea name="" id="" rows="3" class="form-control" placeholder="Bize kısaca kendinizden bahsedin."></textarea>--}}

                                    {{--<label for="diyetisyen_tip" class="mt-2">Hizmet verdiğiniz diyetisyenlik dalı:</label>--}}
                                    {{--<select name="" id="" class="form-control">--}}
                                        {{--@foreach($diyetisyeni_tipleri as $item)--}}
                                            {{--<option value="{{ $item->tip }}">{{ $item->tanim }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}

                                    {{--<label for="ozgecmis" class="mt-2">Özgeçmiş</label>--}}
                                    {{--<input type="file" class="form-control">--}}
                                {{--</div>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Müşterilerinize neler vadediyorsunuz?"></textarea>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><i class="far fa-credit-card"></i> Ödeme Bilgileri</h4>
                                    <hr class="my-4"/>

                                        <div id="iyzipay-checkout-form" class="responsive">
                                        </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="card-text">
                                        <h4 class="h4"><i class="fas fa-question"></i> Ödeme Sonrası Ne Olacak?</h4>
                                        <hr class="my-4"/>
                                        <p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci blanditiis deleniti expedita facilis harum illum libero neque, nostrum obcaecati optio porro, voluptatem? Aliquam aperiam consectetur illo modi nesciunt officiis quae?</p>
                                            <p>Atque error quidem reprehenderit. Blanditiis eius esse fugiat quibusdam rerum! Consequuntur molestiae nam perspiciatis rerum. Aut libero molestias quos tempora tempore. Eius eos esse eum excepturi itaque minus nam veniam?</p>
                                        </p>
                                    </div>
                                </div>
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
        $('#kredi_karti').mask('0000-0000-0000-0000', { placeholder: "16 Haneli Kart Numarası" });
        $('#cvc').mask('000', { placeholder: "Güvenlik Kodu" });
        $('#skt').mask('00/00', { placeholder: "Son Kullanma Tarihi" });
        $('#cep_telefon').mask('+00 (000) 000-00-00', { placeholder: "(___) ___-__-__" });
        $('#tc_no').mask('00000000000', { placeholder: "___________" });
    </script>
    {!! $checkoutFormInitialize->getCheckoutFormContent() !!}

@endpush