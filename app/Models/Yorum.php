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
}
