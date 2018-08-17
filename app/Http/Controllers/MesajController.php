<?php

namespace App\Http\Controllers;

use App\Models\Dosya;
use App\Models\Kullanici;
use App\Models\Mesaj;
use phpDocumentor\Reflection\DocBlock;
use Illuminate\Http\Request;

class MesajController extends Controller
{

    public function alinan_mesajlar()
    {
        $kullanici_id = auth()->user()->id;
        $kullanici = Kullanici::where('id', $kullanici_id)
            ->with('resim')
            ->firstOrFail();

        $mesajlar = Mesaj::where('alici_id', $kullanici_id)
            ->orderByDesc('gonderme_tarihi')
            ->paginate(6);

        return view('kullanici.mesaj.mesaj', compact('kullanici', 'mesajlar'))
            ->with('mesaj_tur', 'mesaj.gonderilenler')
            ->with('mesaj_text', 'Gönderdiklerim');
    }

    public function gonderilen_mesajlar()
    {
        $kullanici_id = auth()->user()->id;
        $kullanici = Kullanici::where('id', $kullanici_id)
            ->with('resim')
            ->firstOrFail();

        $mesajlar = Mesaj::where('gonderici_id', $kullanici_id)
            ->orderByDesc('gonderme_tarihi')
            ->paginate(6);

        return view('kullanici.mesaj.mesaj', compact('kullanici', 'mesajlar'))
            ->with('mesaj_tur', 'mesaj.alinanlar')
            ->with('mesaj_text', 'Alınan Mesajlar');
    }

    public function incele($mesaj_id)
    {
        $kullanici_id = auth()->user()->id;
        $kullanici = Kullanici::where('id', $kullanici_id)
            ->with('resim')
            ->firstOrFail();

        $mesaj = Mesaj::where('id', $mesaj_id)
            ->where(function ($query) use($kullanici_id){
                return $query->where('alici_id', $kullanici_id)->orWhere('gonderici_id', $kullanici_id);
            })
            ->with('gonderici_bilgileri')
            ->firstOrFail();

        return view('kullanici.mesaj.incele', compact('kullanici', 'mesaj'));;

    }

    public function yaz($alici_id, $onceki_mesaj_id = null)
    {
        $kullanici_id = auth()->user()->id;

        $kullanici = Kullanici::where('id', $kullanici_id)
            ->with('resim')
            ->firstOrFail();
        $alici = Kullanici::where('id', $alici_id)
            ->firstOrFail();

        if (($kullanici->seviye == 0 && $alici->seviye == 1) || ($kullanici->seviye == 1 && $alici->seviye == 0))
        {
            $compact_data = [
                'kullanici' => $kullanici,
                'alici'     => $alici
            ];

            if (isset($onceki_mesaj_id))
            {
                $onceki_mesaj = Mesaj::where('id', $onceki_mesaj_id)
                    ->where(function ($query) use($kullanici_id){
                        return $query->where('alici_id', $kullanici_id)->orWhere('gonderici_id', $kullanici_id);
                    })
                    ->firstOrFail();
                $compact_data['onceki_mesaj'] = $onceki_mesaj;
            }

            return view('kullanici.mesaj.gonder', $compact_data);
        }

        return redirect()->route('mesaj.alinanlar')
            ->with('mesaj', $kullanici->seviye == 0 ? 'Yalnızca diyetisyenlere mesaj atabilirsiniz.' : 'Yalnızca kullanıcılara mesaj atabilirsiniz.')
            ->with('mesaj_tur', 'danger');

    }

    public function gonder()
    {
        $kullanici_id = auth()->user()->id;

        $this->validate(\request(), [
            'alici_id'  =>  'required',
            'baslik'    =>  'required|min:5|max:255',
            'mesaj'     =>  'required'
        ]);
        $dosya = new Dosya();
        $data = \request()->only('alici_id', 'baslik', 'mesaj', 'mesaj_id');
        if (\request()->hasFile('dosya_ek'))
        {
            $this->validate(\request(), [
               'dosya_ek'   =>  'image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);

            $dosya_ek = \request()->file('dosya_ek');
            $dosya_ek_adi = $kullanici_id . '-message-' . time() . '.' . $dosya_ek->extension();

            if ($dosya_ek->isValid())
            {
                $dosya_ek->move('uploads/mesaj', $dosya_ek_adi);
                $dosya = Dosya::create([
                   'tip_id' =>  '1',
                   'tip'    =>  'mesaj_ek',
                   'klasor' =>  'uploads/mesaj',
                   'url'    =>  $dosya_ek_adi
                ]);
            }

        }
        $mesaj = Mesaj::create([
            'onceki_mesaj_id'   =>  \request('mesaj_id'),
            'gonderici_id'      =>  $kullanici_id,
            'alici_id'          =>  \request('alici_id'),
            'dosya_id'          =>  $dosya->id,
            'baslik'            =>  \request('baslik'),
            'mesaj'             =>  \request('mesaj')
        ]);
        return redirect()->route('mesaj.alinanlar')
            ->with('mesaj', 'Mesaj başarıyla gönderildi!')
            ->with('mesaj_tur', 'success');
    }

    public function sil()
    {
        $mesaj_id = \request('mesaj_id');
        $mesaj = Mesaj::find($mesaj_id);
        $mesaj->delete();
        return redirect()->route('mesaj.alinanlar')->with('mesaj', 'Mesaj başarıyla silindi!')->with('mesaj_tur', 'success');
    }

}
