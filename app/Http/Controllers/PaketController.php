<?php

namespace App\Http\Controllers;

use App\Models\DiyetisyenTip;
use App\Models\Kullanici;
use App\Models\Mesaj;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PaketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $ku_id = Auth::user()->id;
            $okunmamis_mesaj_sayisi = Mesaj::where('mesaj.alici_id', $ku_id)->where('mesaj.okunma_tarihi', null)->count();
            View::share('okunmamis_mesaj_sayisi', $okunmamis_mesaj_sayisi);

            return $next($request);
        });
    }

    public function diyetisyen_kayit()
    {
        $kullanici_id = \auth()->user()->id;

        $kullanici = Kullanici::with('diyetisyen')->where('id', $kullanici_id)->firstOrFail();

        $paketler = Paket::all();
        return view('paket.diyetisyen_kayit', compact('kullanici', 'paketler'));
    }

    public function satin_al($paket_id)
    {
        $kullanici_id = \auth()->user()->id;

        $kullanici = Kullanici::with('diyetisyen')->where('id', $kullanici_id)->firstOrFail();

        $paket =  Paket::where('id', $paket_id)->firstOrFail();

        $diyetisyeni_tipleri = DiyetisyenTip::all();
        return view('paket.satin_al', compact('paket', 'kullanici', 'diyetisyeni_tipleri'));
    }
}
