<?php

namespace App\Http\Controllers;

use App\Models\Kullanici;
use App\Models\Yorum;
use Illuminate\Http\Request;

class YorumController extends Controller
{
    public function yorum_sayfa($kullanici_adi)
    {
        $kullanici = Kullanici::where('kullanici_adi', $kullanici_adi)->first();
        return view('diyetisyen.yorum_yap', compact('kullanici'));
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
        $yorum_kontrol = Yorum::where('kullanici_id', $yorum_yapan->id)->count();

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
