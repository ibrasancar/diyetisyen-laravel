<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\KullaniciKayitMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['cikis']);
    }

    public function giris()
    {
        return view('auth.giris');
    }

    public function giris_islem()
    {
        $this->validate(\request(), [
            'email'  =>  'required|email',
            'sifre'  =>  'required'
        ]);

        $credentials = [
            'email'     =>  \request('email'),
            'password'  =>  \request('sifre')
        ];

        if (auth()->attempt($credentials, \request()->has('benihatirla')))
        {
            return redirect()->intended('/');
        }
        else
        {
            $errors = ['email' => 'Hatalı giriş'];
            return back()->withErrors($errors);
        }
    }

    public function kayit()
    {
        return view('auth.kayit');
    }

    public function kayit_islem()
    {
        $this->validate(\request(), [
            'ad_soyad'      =>  'required|min:5|max:50',
            'email'         =>  'required|email|unique:kullanici',
            'sifre'         =>  'required|confirmed|min:5|max:15',
            'kullanici_adi' =>  'required|min:4|max:15|unique:kullanici',
            'cep_telefon'   =>  'required',
            'tc_no'         =>  'required|integer|min:11',
            'dogum_tarihi'  =>  'required|date|date_format:Y-m-d',
            'adres'         =>  'required'
        ]);

        $kullanici = Kullanici::create([
            'seviye'        =>  0,
            'kullanici_adi' =>  \request('kullanici_adi'),
            'sifre'         =>  Hash::make(\request('sifre')),
            'email'         =>  \request('email'),
            'ad_soyad'      =>  \request('ad_soyad'),
            'telefon'       =>  \request('telefon'),
            'cep_telefon'   =>  \request('cep_telefon'),
            'adres'         =>  \request('adres'),
            'resim_id'      =>  1,
            'tc_no'         =>  \request('tc_no'),
            'dogum_tarihi'  =>  \request('dogum_tarihi'),
        ]);

        $kullanici->sosyal_medya()->create(['tip'   =>  'facebook', 'deger' =>  '']);
        $kullanici->sosyal_medya()->create(['tip'   =>  'twitter', 'deger' =>  '']);
        $kullanici->sosyal_medya()->create(['tip'   =>  'linkedin', 'deger' =>  '']);

        Mail::to(\request('email'))->send(new KullaniciKayitMail($kullanici));

        auth()->login($kullanici);

        return redirect()->route('anasayfa');
    }

    public function cikis()
    {
        auth()->logout();
        \request()->session()->flush();
        \request()->session()->regenerate();
        return redirect()->route('anasayfa');
    }
}
