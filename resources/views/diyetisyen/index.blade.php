@extends('layouts.master')
@section('title', 'Diyetisyenler - Diyetisyen Portalı')

@section('content')

    <!-- Home -->

    <div class="home">
        <div class="home_background_container prlx_parent">
            <div class="home_background prlx" style="background-image:url(/images/teachers_background.jpg)"></div>
        </div>
        <div class="home_content">
            <h1>Diyetisyenler</h1>
        </div>
    </div>

    <!-- Teachers -->

    <div class="teachers page_section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-12">

                    <form action="{{route('diyetisyen')}}" method="post">
                        {{csrf_field()}}

                        <div class="form-inline">
                            <label for="ara" class="mr-1">Diyetisyen Ara:</label>
                            <input type="text" name="ara" id="ara" class="form-control mr-2" value="{{ old('ara') }}" placeholder="Diyetisyen adıyla ara...">

                            <label for="ara" class="mr-1">Diyetisyen Tipi:</label>
                            <select name="diyetisyen_tip" id="diyetisyen_tip" class="form-control">
                                <option value="">Diyetisyen Tipi</option>
                                @foreach($tipler as $tip)
                                    <option value="{{ $tip->tip }}" {{ old('diyetisyen_tip') == $tip->tip ? 'selected' : '' }}>{{ $tip->tanim }}</option>
                                @endforeach
                            </select>

                            <label class="ml-1 mr-1" for="sirala">Sırala:</label>
                            <select name="sirala" id="sirala" class="form-control">
                                <option value="puan" {{ old('sirala') == $sirala ? 'selected' : '' }}>Puana göre sırala</option>
                                <option value="ad_soyad" {{ old('sirala') == $sirala ? 'selected' : '' }}>İsme göre sırala</option>
                            </select>

                            <button type="submit" class="btn btn-primary ml-2" style="cursor: pointer;">Gönder</button>
                            <a class="btn btn-primary ml-2" href="{{ route('diyetisyen') }}">Temizle</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
            @foreach($diyetisyenler as $diyetisyen)
                <!-- Teacher -->
                <div class="col-lg-4 teacher">
                    <div class="card">
                        <div class="card_img">
                            <div class="card_plus trans_200 text-center" style="z-index: 1;"><a href="{{ route('diyetisyen.incele', $diyetisyen->kullanici->kullanici_adi) }}">+</a></div>
                            <img class="card-img-top trans_200" src="/{{ $diyetisyen->kullanici->resim->klasor }}/{{ $diyetisyen->kullanici->resim->url }}" alt="">
                        </div>
                        <div class="card-body text-center">
                            <div class="card-title"><a href="{{ route('diyetisyen.incele', $diyetisyen->kullanici->kullanici_adi) }}">{{ $diyetisyen->kullanici->ad_soyad }}</a></div>
                            <div class="card-text">{{ $diyetisyen->diyetisyen_tip->tanim }}</div>
                            <div class="card-text mt-1">{{ $diyetisyen->aciklama }}</div>
                            <div class="teacher_social">
                                <ul class="menu_social">
                                    @foreach($diyetisyen->kullanici->sosyal_medya as $item)
                                        <li class="menu_social_item"><a href="{{ $item->deger }}"><i class="fab fa-{{ $item->tip }}"></i></a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="teacher_social">
                                Puan:
                                @for($i = 1; $i <= $diyetisyen->puan; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                @if($diyetisyen->puan - floor($diyetisyen->puan) > 0.0 && $diyetisyen->puan < 5)
                                    <i class="fa fa-star-half"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            <div class="mt-5" style="display: flex; justify-content: center;">
                {{ $diyetisyenler->links() }}
            </div>
        </div>
    </div>

    <!-- Milestones -->

    <div class="milestones">
        <div class="milestones_background" style="background-image:url(images/milestones_background.jpg)"></div>

        <div class="container">
            <div class="row">

                <!-- Milestone -->
                <div class="col-lg-3 milestone_col">
                    <div class="milestone text-center">
                        <div class="milestone_icon"><img src="images/milestone_1.svg" alt="https://www.flaticon.com/authors/zlatko-najdenovski"></div>
                        <div class="milestone_counter" data-end-value="750">0</div>
                        <div class="milestone_text">Current Students</div>
                    </div>
                </div>

                <!-- Milestone -->
                <div class="col-lg-3 milestone_col">
                    <div class="milestone text-center">
                        <div class="milestone_icon"><img src="images/milestone_2.svg" alt="https://www.flaticon.com/authors/zlatko-najdenovski"></div>
                        <div class="milestone_counter" data-end-value="120">0</div>
                        <div class="milestone_text">Certified Teachers</div>
                    </div>
                </div>

                <!-- Milestone -->
                <div class="col-lg-3 milestone_col">
                    <div class="milestone text-center">
                        <div class="milestone_icon"><img src="images/milestone_3.svg" alt="https://www.flaticon.com/authors/zlatko-najdenovski"></div>
                        <div class="milestone_counter" data-end-value="39">0</div>
                        <div class="milestone_text">Approved Courses</div>
                    </div>
                </div>

                <!-- Milestone -->
                <div class="col-lg-3 milestone_col">
                    <div class="milestone text-center">
                        <div class="milestone_icon"><img src="images/milestone_4.svg" alt="https://www.flaticon.com/authors/zlatko-najdenovski"></div>
                        <div class="milestone_counter" data-end-value="3500" data-sign-before="+">0</div>
                        <div class="milestone_text">Graduate Students</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Become -->

    <div class="become">
        <div class="container">
            <div class="row row-eq-height">

                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="become_title">
                        <h1>Become a teacher</h1>
                    </div>
                    <p class="become_text">In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies venenatis. Suspendisse fermentum sodales lacus, lacinia gravida elit dapibus sed. Cras in lectus elit. Maecenas tempus nunc vitae mi egestas venenatis. Aliquam rhoncus, purus in vehicula porttitor, lacus ante consequat purus, id elementum enim purus nec enim. In sed odio rhoncus, tristique ipsum id, pharetra neque.</p>
                    <div class="become_button text-center trans_200">
                        <a href="#">Read More</a>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="become_image">
                        <img src="images/become.jpg" alt="">
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