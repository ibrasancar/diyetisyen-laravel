<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiyetisyenOzellik extends Model
{
    public $timestamps = false;

    protected $table = 'diyetisyen_ozellik';

    protected $guarded = [];

    public function diyetisyen()
    {
        return $this->belongsTo('App\Models\Diyetisyen')->with('kullanici');
    }
}
