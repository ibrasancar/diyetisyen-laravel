<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SosyalMedya extends Model
{
    protected $table = 'sosyalmedya';

    protected $guarded = [];
    public $timestamps = false;

    protected $fillable = [
        'tip', 'deger'
    ];
    public function kullanici()
    {
        return $this->belongsToMany('App\Models\Kullanici')->with('diyetisyen');
    }

}
