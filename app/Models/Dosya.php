<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosya extends Model
{

    protected $table = 'dosya';

    public $timestamps = false;

    protected $fillable = [
        'tip_id', 'tip', 'klasor', 'url', 'is_down'
    ];

    protected $guarded = [];

    public function kullanici()
    {
        return $this->belongsTo('App\Models\Kullanici');
    }
    public function mesaj()
    {
        return $this->hasOne('App\Models\Mesaj', 'id', 'dosya_id');
    }
}
