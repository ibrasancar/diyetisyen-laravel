<?php

namespace App\Http\Controllers;

use App\Models\DiyetisyenTip;
use App\Models\Kullanici;
use Illuminate\Http\Request;

class SayfaController extends Controller
{
    public function index()
    {
        return view('anasayfa');
    }
}
