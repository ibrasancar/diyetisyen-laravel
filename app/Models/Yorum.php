<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Yorum extends Model
{
    use SoftDeletes;
    protected $table = 'yorum';

    const CREATED_AT = 'gonderme_tarihi';
    const DELETED_AT = 'silinme_tarihi';
    const UPDATED_AT = null;

    protected $guarded = [];

    protected $fillable = [
        'kullanici_id', 'diyetisyen_id', 'yorum'
    ];

    public function kullanici()
    {
        return $this->belongsTo('App\Models\Kullanici', 'kullanici_id', 'id');
    }

    public function puan()
    {
        return $this->hasOne('App\Models\Puan', 'kullanici_id', 'kullanici_id');
    }
}
