@extends('layouts.master')
@section('title', 'Hesap Ayarlarım - Diyetisyen Portalı')

@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('layouts.partials.alert')
            @include('layouts.partials.errors')

            <div class="col-md-12">
                <h2 class="h2">
                    Diyetisyen Kaydı
                </h2>
                <p class="lead">
                    Diyetisyenler için özel paketlerimiz!
                </p>
                <hr class="my-4"/>
            </div>


            @foreach($paketler as $item)
                <div class="col-lg-4 col-md-4 col-sm-12 mt-2 mb-4">
                    <div class="card text-center {{ $item->id == 2 ? 'border-success' : '' }}{{ $item->id == 3 ? 'border-danger' : '' }} overflow-hidden">
                        <div class="card-body p-0">
                            <div class="card-header text-center">
                                <h3>
                                    {{ $item->tanim }}
                                </h3>
                                @if($item->id == 2)
                                    <span class="badge badge-success badge-indirim" style="position: absolute">
                                        EN ÇOK SATAN
                                    </span>
                                @endif
                                @if($item->id == 3)
                                    <span class="badge badge-danger badge-indirim" style="position: absolute">
                                        %20 İNDİRİM!
                                    </span>
                                @endif
                            </div>
                            <div class="card-text p-3 pr-4">
                                <p>
                                    {{ $item->icerik }}
                                </p>
                                <a href="{{ route('paket.satin_al', $item->id)}}" class="btn display-2 {{ $item->id == 2 ? 'btn-success' : 'btn-info' }} {{ $item->id == 3 ? 'btn-danger' : '' }}">
                                    {{ $item->ucret }} ₺</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            <div class="col-md-12 mt-4">
                <h3>Neden Diyetisyenler Bizi Tercih Etmeli?</h3>
                <hr class="my-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit magna ac nisi pharetra, at euismod nulla viverra. Suspendisse id sagittis felis, eu mattis risus. Sed eu mollis ligula. Pellentesque rhoncus eget mauris eu placerat. Quisque faucibus dui ac arcu tempor vestibulum. Vestibulum commodo posuere magna. Sed in enim at nisl maximus egestas eu vel turpis. Nam dapibus tortor orci. Aliquam convallis eros vitae magna dictum, ut dapibus felis pellentesque. Aliquam id justo sagittis, pulvinar quam eget, convallis orci. Vivamus ac sem a augue venenatis pulvinar eget a sapien. Praesent feugiat a justo viverra facilisis.</p>
                <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus facilisis lacus arcu, vel tempor sem tincidunt at. Etiam pretium pharetra commodo. Nam pharetra pellentesque ex, non efficitur sem blandit et. Cras venenatis iaculis lectus, sodales commodo enim pretium nec. Aliquam at pulvinar orci. Vestibulum ornare vel justo nec facilisis. Praesent lectus nisl, eleifend et maximus vestibulum, sagittis nec ex. Nunc consectetur felis eu ultricies pellentesque. Cras bibendum iaculis sapien ac vulputate. Quisque imperdiet vulputate libero, et laoreet felis feugiat vitae.</p>
                <p>Fusce mattis, justo at feugiat faucibus, velit dui elementum leo, id dapibus enim enim eget lorem. Quisque et dui porta, aliquet elit eget, auctor ligula. Nam quis tempor arcu. Nam molestie libero nibh, et lobortis lorem rhoncus a. Etiam ultricies nisl at velit facilisis, non efficitur metus hendrerit. In aliquet vitae ipsum eu lacinia. Suspendisse at est eget velit laoreet euismod a in eros. Ut aliquam diam ac aliquam laoreet. Aliquam vel velit a massa pellentesque tristique. Nullam maximus tellus dolor, tempor tempus neque efficitur id. Maecenas varius ligula ac turpis dictum, a porttitor massa egestas.</p>
                <p>Cras rutrum suscipit risus, sed sodales felis pellentesque at. Pellentesque ipsum ante, tempus sed enim gravida, suscipit ullamcorper tellus. Maecenas blandit leo eu magna mollis maximus. Vestibulum egestas varius arcu, a condimentum velit tincidunt tincidunt. Nulla condimentum tincidunt egestas. Sed rutrum nisl et purus rutrum efficitur. Suspendisse nec convallis metus, ut fermentum nulla.</p>
                <p>Etiam vel libero laoreet, iaculis arcu tempus, dapibus magna. Nullam nec pulvinar lorem. In condimentum congue massa. Vivamus volutpat eu arcu ullamcorper maximus. Donec id leo ut purus scelerisque congue et sit amet arcu. Nunc finibus odio in lectus accumsan, ut eleifend nunc consectetur. Nulla consequat elit et mi volutpat, et ullamcorper nulla scelerisque. Cras at felis viverra, fermentum dui ac, vehicula tellus. Proin quis ullamcorper sem, in varius sem. Phasellus iaculis diam ipsum, sed tempor est bibendum at. Etiam placerat hendrerit ante et accumsan.</p>
            </div>


        </div>
    </div>
@endsection
@section('styles')
    <style>
        span.badge.badge-indirim:hover{
            opacity: 1;
        }
        span.badge.badge-indirim {
            font-size: 16px;
            font-weight: lighter;
            padding: 10px 0px;
            right: -55px;
            top: 25px;
            transform: rotate(35deg);
            width: 250px;
            opacity: .8;
            cursor: pointer;
            transition: all 500ms;
        }
    </style>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('#telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
        $('#cep_telefon').mask('+00 (000) 000-00-00', { placeholder: "(___) ___-__-__" });
        $('#tc_no').mask('00000000000', { placeholder: "___________" });
    </script>
@endpush