<?php

namespace App\Http\Controllers;

use App\Models\Diyetisyen;
use App\Models\Kullanici;
use App\Models\Mesaj;
use App\Models\Puan;
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
        $kullanici = Kullanici::where('kullanici_adi', $kullanici_adi)->with('diyetisyen')->first();
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
            'yorum'             => \request('yorum')
        ]);

        #yorum puanı güncelleme
        $toplam_yorum = Puan::where('diyetisyen_id', $kullanici->id)->get();
        $verilen_puan = \request('puan');
        if(is_null($toplam_yorum))
        {
            $kullanici->diyetisyen()->update(['puan' => $verilen_puan]);
        }
        else
        {
            #puan hesaplaması
            $toplam_puan = 0.0;
            foreach ($toplam_yorum as $item)
            {
                $toplam_puan += $item->puan;
            }
            $toplam_yorum_sayisi = (float)count($toplam_yorum) + 1;
            $puan_guncelle = ($toplam_puan + $verilen_puan) / $toplam_yorum_sayisi;
            #puan güncelle
            $kullanici->diyetisyen()->update(['puan' => $puan_guncelle]);
        }

        Puan::create([
            'kullanici_id'      => $yorum_yapan->id,
            'diyetisyen_id'     => $kullanici->id,
            'puan'              => \request('puan')
        ]);

        return redirect()->route('diyetisyen.incele', $kullanici_adi)
            ->with('mesaj', 'Yorum başarıyla gönderildi, incelemeden sonra yayınlanacaktır.')
            ->with('mesaj_tur', 'success');

    }
}
