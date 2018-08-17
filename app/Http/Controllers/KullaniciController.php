<?php

namespace App\Http\Controllers;

use App\Models\Dosya;
use App\Models\Kullanici;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KullaniciController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function panel()
    {
        $kullanici_id = auth()->user()->id;
        $kullanici = Kullanici::with('resim')
            ->with('sosyal_medya')
            ->find($kullanici_id);
        return view('kullanici.panel', compact('kullanici'));
    }

    public function guncelle()
    {
        $this->validate(request(), [
            'ad_soyad'      =>  'required|min:5|max:50',
            'email'         =>  (request('original_email') != request('email') ? 'required|email|unique:kullanici' : ''),
            'kullanici_adi' =>  (request('original_kullanici_adi') != request('kullanici_adi') ? 'required|min:4|max:15|unique:kullanici' : ''),
            'cep_telefon'   =>  'required',
            'tc_no'         =>  'required|integer|min:11',
            'dogum_tarihi'  =>  'required|date|date_format:Y-m-d',
            'adres'         =>  'required'
        ]);

        $data = request()->only('ad_soyad', 'email', 'kullanici_adi', 'cep_telefon', 'telefon', 'tc_no', 'dogum_tarihi', 'adres');
        if (request()->filled('sifre'))
        {
            $this->validate(request(), [
                'sifre'         =>  'required|confirmed|min:5|max:15',
            ]);
            $data['sifre'] = Hash::make(request('sifre'));
        }

        $kullanici_id = auth()->user()->id;
        $entry = Kullanici::with('sosyal_medya')->where('id', $kullanici_id)->firstOrFail();
        $entry->update($data);

        $entry->sosyal_medya()->where('tip', 'facebook')->update(['deger' => \request('facebook')]);
        $entry->sosyal_medya()->where('tip', 'twitter')->update(['deger' => \request('twitter')]);
        $entry->sosyal_medya()->where('tip', 'linkedin')->update(['deger' => \request('linkedin')]);

        return redirect()
            ->route('kullanici.panel')
            ->with('mesaj', 'Ayarlarınız güncellendi!')
            ->with('mesaj_tur', 'success');
    }

    public function avatar()
    {
        $kullanici_id = auth()->user()->id;
        $kullanici = Kullanici::where('id', $kullanici_id)
            ->with('resim')
            ->firstOrFail();

        return view('kullanici.avatar', compact('kullanici'));
    }

    public function avatar_guncelle()
    {
        $kullanici_id = auth()->user()->id;
        $kullanici = Kullanici::with('resim')
            ->find($kullanici_id);

        $gun = new Carbon($kullanici->resim->upload_tarihi);
        $simdi = Carbon::now();

        if (\request()->hasFile('avatar'))
        {
            $this->validate(\request(), [
                'avatar'    =>  'image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);

            $avatar = \request()->file('avatar');
            $avatar_adi = $kullanici_id . "-" . time() . "." . $avatar->extension();

            if ($avatar->isValid())
            {
                $avatar->move('uploads/avatar', $avatar_adi);
                $dosya = Dosya::create([
                    'tip_id'    =>  0,
                    'tip'       =>  'avatar',
                    'klasor'    =>  'uploads/avatar',
                    'url'       =>  $avatar_adi,
                ]);
                $kullanici->resim_id = $dosya->id;
                $kullanici->save();
            }
        }
        $kullanici = Kullanici::with('resim')
            ->find($kullanici_id);
        return view('kullanici.avatar', compact('kullanici'))
            ->with('mesaj', 'Avatar güncellendi!')
            ->with('mesaj_tur', 'success');
    }


}
