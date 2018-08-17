<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiyetisyenTip extends Model
{
    protected $table = 'diyetisyen_tip';

    protected $guarded = [];
    public $timestamps = false;


    public function diyetisyen()
    {
        return $this->hasMany('App\Models\Diyetisyen');
    }
}
