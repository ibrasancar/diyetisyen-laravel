<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kullanici extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'kullanici';

    const CREATED_AT = 'olusturma_tarihi';
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    protected $fillable = [
        'kullanici_adi', 'ad_soyad', 'email', 'sifre', 'telefon', 'cep_telefon', 'adres', 'tc_no', 'dogum_tarihi', 'resim_id'
    ];

    protected $hidden = [
        'sifre'
    ];

    protected $guarded = [];

    public function getAuthPassword()
    {
        return $this->sifre;
    }

    public function diyetisyen()
    {
        return $this->hasOne('App\Models\Diyetisyen')->with('diyetisyen_tip');
    }

    public function resim()
    {
        return $this->hasOne('App\Models\Dosya', 'id', 'resim_id');
    }

    public function sosyal_medya()
    {
        return $this->hasMany('App\Models\SosyalMedya');
    }

    public function giden_mesaj()
    {
        return $this->hasMany('App\Models\Mesaj', 'gonderici_id', 'id');
    }

    public function alinan_mesaj()
    {
        return $this->hasMany('App\Models\Mesaj', 'alici_id', 'id');
    }

    public function alinan_yorum()
    {
        return $this->hasMany('App\Models\Yorum', 'diyetisyen_id', 'id')->with('kullanici');
    }

    public function diyetisyen_mi()
    {
        return $this->attributes['seviye'] == 1;
    }

    public function kullanici_mi()
    {
        return $this->attributes['seviye'] == 0;
    }

}
