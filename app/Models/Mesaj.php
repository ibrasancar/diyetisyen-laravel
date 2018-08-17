<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mesaj extends Model
{
    use SoftDeletes;
    protected $table = 'mesaj';

    const CREATED_AT = 'gonderme_tarihi';
    const DELETED_AT = 'silinme_tarihi';
    const UPDATED_AT = null;


    protected $fillable = [
        'onceki_mesaj_id', 'gonderici_id', 'alici_id', 'dosya_id', 'baslik', 'mesaj', 'okunma_tarihi'
    ];

    protected $guarded = [];

    public function gonderici_bilgileri()
    {
        return $this->belongsTo('App\Models\Kullanici', 'gonderici_id', 'id');
    }

    public function giden_mesaj()
    {
        return $this->belongsToMany('App\Models\Kullanici', 'kullanici', 'id', 'gonderici_id');
    }
    public function alinan_mesaj()
    {
        return $this->belongsToMany('App\Models\Kullanici', 'kullanici', 'id', 'alinan_mesaj');
    }

    public function dosya()
    {
        return $this->hasOne('App\Models\Dosya', 'dosya_id', 'id');
    }
}
