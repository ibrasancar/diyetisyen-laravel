@extends('layouts.master')
@section('title', config('app.name'))
@section('content')

    @include('layouts.partials.alert')

    @include('anasayfa.guest')

    @include('anasayfa.kullanici')

    @include('anasayfa.diyetisyen')



@endsection

