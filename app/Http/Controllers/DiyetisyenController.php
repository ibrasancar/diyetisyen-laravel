<?php

namespace App\Http\Controllers;

use App\Models\Diyetisyen;
use App\Models\DiyetisyenTip;
use App\Models\Kullanici;
use Illuminate\Http\Request;

class DiyetisyenController extends Controller
{
    public function index()
    {
        $sirala = 'puan';
        if(request()->filled('ara') || request()->filled('diyetisyen_tip') || \request()->filled('sirala'))
        {
            request()->flash();
            $ara = request('ara');
            $diyetisyen_tip = request('diyetisyen_tip');
            $sirala = \request('sirala');
            $diyetisyenler = Diyetisyen::with('kullanici')
                ->with('kullanici.sosyal_medya')
                ->with('kullanici.resim')
                ->with('diyetisyen_tip')
                ->join('kullanici', 'kullanici.id', 'diyetisyen.kullanici_id')
                ->where('ad_soyad', 'like', "%$ara%")
                ->when($diyetisyen_tip, function ($query, $diyetisyen_tip) {
                    return $query->where('tip', $diyetisyen_tip);
                })
                ->orderBy($sirala, $sirala == 'ad_soyad' ? 'asc' : 'desc')
                ->paginate(6)
                ->appends([
                    'ara' => $ara,
                    'diyetisyen_tip' => $diyetisyen_tip,
                    'sirala' => $sirala
                ]);
            # !!! EKLE !!!  kayıt tarihine göre sıralanacak
        }
        else
        {
            request()->flush();
            $diyetisyenler = Diyetisyen::with('kullanici')
                ->with('kullanici.sosyal_medya')
                ->with('kullanici.resim')
                ->with('diyetisyen_tip')
                ->orderByDesc('puan')
                ->paginate(6);
        }
        $tipler = DiyetisyenTip::all();
        return view('diyetisyen.index', compact('diyetisyenler', 'tipler', 'sirala'));
    }

    public function incele($kullanici_adi)
    {
        $kullanici = Kullanici::with('diyetisyen')
            ->with('sosyal_medya')
            ->with('resim')
            ->where('kullanici_adi', $kullanici_adi)->firstOrFail();
        return view('diyetisyen.incele', compact('kullanici'));
    }
}
