<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puan extends Model
{
    protected $table = 'puan';

    public $timestamps = false;

    protected $guarded = [];

    protected $fillable = [
        'kullanici_id', 'diyetisyen_id', 'puan'
    ];

    public function kullanici()
    {
        return $this->belongsTo('App\Models\Kullanici', 'kullanici_id', 'id');
    }
    public function diyetisyen()
    {
        return $this->belongsTo('App\Models\Diyetisyen', 'diyetisyen_id', 'id');
    }
    public function yorum()
    {
        return $this->belongsTo('App\Models\Yorum', 'kullanici_id', 'kullanici_id');
    }
}
