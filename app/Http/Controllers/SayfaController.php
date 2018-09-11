<?php

namespace App\Http\Controllers;

use App\Models\DiyetisyenOzellik;
use App\Models\DiyetisyenTip;
use App\Models\Kullanici;
use App\Models\Mesaj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SayfaController extends Controller
{

    public function index()
    {
        if(isset(Auth::user()->id)){
            $ku_id = Auth::user()->id;
            $okunmamis_mesaj_sayisi = Mesaj::where('mesaj.alici_id', $ku_id)->where('mesaj.okunma_tarihi', null)->count();

        }

        $anasayfa_diyetisyen = DiyetisyenOzellik::with('diyetisyen')->where('anasayfa_goster', 1)->get();
        return view('anasayfa.index', compact('anasayfa_diyetisyen', 'okunmamis_mesaj_sayisi', 'kullanici'));
    }

}
