<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';
    public $timestamps = null;

    protected $fillable  = [
        'tanim',
        'icerik',
        'ucret'
    ];

    protected $guarded = [];

}
