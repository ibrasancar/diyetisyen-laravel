<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diyetisyen extends Model
{
    protected $table = 'diyetisyen';

    protected $guarded = [];
    public $timestamps = false;

    public function kullanici()
    {
        return $this->belongsTo('App\Models\Kullanici');
    }
    public function diyetisyen_tip()
    {
        return $this->belongsTo('App\Models\DiyetisyenTip', 'tip', 'tip');
    }

    public function sosyalmedya()
    {
        return $this->hasMany('App\Models\SosyalMedya', 'kullanici_id', 'kullanici_id');
    }
}
