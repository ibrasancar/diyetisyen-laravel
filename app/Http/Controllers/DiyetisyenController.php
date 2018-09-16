<?php

namespace App\Http\Controllers;

use App\Models\Diyetisyen;
use App\Models\DiyetisyenTip;
use App\Models\Kullanici;
use App\Models\Mesaj;
use App\Models\Puan;
use App\Models\Yorum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DiyetisyenController extends Controller
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

    public function index()
    {
        $sirala = 'puan';
        if(request()->filled('ara') || request()->filled('diyetisyen_tip') || \request()->filled('sirala'))
        {
            request()->flash();
            $ara = request('ara');
            $diyetisyen_tip = request('diyetisyen_tip');

            #farklı sayfalardan gelen arama isteği için yapıldı
            if ($sirala != 'puan')
            {
                $sirala = \request('sirala');
            }

            $diyetisyenler = Diyetisyen::with('kullanici')
                ->with('kullanici.sosyal_medya')
                ->with('kullanici.resim')
                ->with('diyetisyen_tip')
                ->join('kullanici', 'kullanici.id', 'diyetisyen.kullanici_id')
                ->where('seviye', 1)
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
                ->join('kullanici', 'kullanici.id', 'diyetisyen.kullanici_id')
                ->where('seviye', 1)
                ->orderByDesc('puan')
                ->paginate(6);
        }
        $diyetisyen_sayisi = Kullanici::where('seviye', 1)->count();
        $tipler = DiyetisyenTip::all();
        return view('diyetisyen.listele.index', compact('diyetisyenler', 'tipler', 'sirala', 'diyetisyen_sayisi'));
    }

    public function incele($kullanici_adi)
    {
        $kullanici = Kullanici::with('diyetisyen')
            ->with('sosyal_medya')
            ->with('resim')
            ->where('kullanici_adi', $kullanici_adi)->firstOrFail();

        $alinan_yorumlar = Yorum::where('diyetisyen_id', $kullanici->id)
            ->with('puan')
            ->orderByDesc('gonderme_tarihi')
            ->paginate(6);

        $kullanici_yorumu = Yorum::where('kullanici_id', auth()->user()->id)->where('diyetisyen_id', $kullanici->id)->with('puan')->first();
        return view('diyetisyen.incele.index', compact('kullanici', 'alinan_yorumlar', 'kullanici_yorumu'));
    }
}
