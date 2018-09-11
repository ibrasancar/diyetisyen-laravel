@extends('layouts.master')
@section('title', $kullanici->ad_soyad . ' - ' . config('app.name'))
@section('content')
        <div class="container mt-5">
            <div class="row">

                <!-- Teacher -->
                @include('diyetisyen.incele.sol_panel')

                <div class="col-lg-8">
                    @include('layouts.partials.alert')
                    @include('layouts.partials.errors')
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="card-header">
                                <h2>Yorum Yap</h2>
                            </div>
                            <div class="card-text">
                                <form action="{{ route('diyetisyen.yorum_sayfa', $kullanici->kullanici_adi) }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row p-4">
                                        <div class="col-md-12">
                                            <textarea name="yorum" id="yorum" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="col-md-12 pt-2 pb-4">
                                            <div class="row">
                                                <div class="col-md-6 float-left">
                                                    <button type="submit" class="btn btn-success" style="cursor:pointer;">Gönder <i class="fa fa-chevron-right" ></i></button>
                                                </div>

                                                <div class="col-md-6 float-right">
                                                    <select id="puan" name="puan">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>

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
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.barrating.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#puan').barrating({
                theme: 'fontawesome-stars'
            });
        });
    </script>
@endpush

