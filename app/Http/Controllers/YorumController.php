<?php

namespace App\Http\Controllers;

use App\Models\Kullanici;
use App\Models\Mesaj;
use App\Models\Yorum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class YorumController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        Carbon::setLocale('tr');

        $this->middleware(function ($request, $next) {
            $ku_id = Auth::user()->id;
            $okunmamis_mesaj_sayisi = Mesaj::where('mesaj.alici_id', $ku_id)->where('mesaj.okunma_tarihi', null)->count();
            View::share('okunmamis_mesaj_sayisi', $okunmamis_mesaj_sayisi);

            return $next($request);
        });
    }

    public function yorum_sayfa($kullanici_adi)
    {
        $kullanici = Kullanici::where('kullanici_adi', $kullanici_adi)->firstOrFail();
        return view('diyetisyen.incele.yorum_yap', compact('kullanici'));
    }

    public function yorum_yap($kullanici_adi){
        $kullanici = Kullanici::where('kullanici_adi', $kullanici_adi)->first();
        $yorum_yapan = auth()->user();

        if($yorum_yapan->seviye >= 1){
            return redirect()->route('diyetisyen.incele', $kullanici_adi)
                ->with('mesaj', 'Yalnızca kullanıcılar yorum yapabilir.')
                ->with('mesaj_tur', 'danger');
        }

        #daha önce yorum yapılmış mı?
        $yorum_kontrol = Yorum::where('kullanici_id', $yorum_yapan->id)->where('diyetisyen_id', $kullanici->id)->count();

        if ($yorum_kontrol > 0){
            return redirect()->route('diyetisyen.incele', $kullanici_adi)
                ->with('mesaj', 'Yalnızca 1 kez yorum yapabilirsiniz.')
                ->with('mesaj_tur', 'danger');
        }

        $this->validate(\request(), [
            'yorum'     =>  'required|min:20|max:1024',
            'puan'      =>  'required|min:1|max:5'
        ]);

        Yorum::create([
            'kullanici_id'      => $yorum_yapan->id,
            'diyetisyen_id'     => $kullanici->id,
            'puan'              => \request('puan'),
            'yorum'             => \request('yorum')
        ]);

        return redirect()->route('diyetisyen.incele', $kullanici_adi)
            ->with('mesaj', 'Yorum başarıyla gönderildi, incelemeden sonra yayınlanacaktır.')
            ->with('mesaj_tur', 'success');

    }
}
