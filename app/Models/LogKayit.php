<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogKayit extends Model
{
    use SoftDeletes;
    protected $table = 'log_kayit';

    const CREATED_AT = 'giris_tarihi';
    const DELETED_AT = 'cikis_tarihi';

}
