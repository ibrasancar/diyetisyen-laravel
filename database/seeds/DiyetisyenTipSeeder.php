<?php

use App\Models\DiyetisyenTip;
use Illuminate\Database\Seeder;

class DiyetisyenTipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('diyetisyen_tip')->insert(['tip' => 1, 'tanim' => 'Diyetisyen']);
        DB::table('diyetisyen_tip')->insert(['tip' => 2, 'tanim' => 'Sağlık Diyetisyeni']);
        DB::table('diyetisyen_tip')->insert(['tip' => 3, 'tanim' => 'Spor Diyetisyeni']);
        DB::table('diyetisyen_tip')->insert(['tip' => 4, 'tanim' => 'Yeminli Diyetisyen']);
        DB::table('diyetisyen_tip')->insert(['tip' => 5, 'tanim' => 'Vallahi Diyetisyen']);
        DB::table('diyetisyen_tip')->insert(['tip' => 6, 'tanim' => 'Kuran Çarpsın Diyetisyen']);
        DB::table('diyetisyen_tip')->insert(['tip' => 7, 'tanim' => 'Doldurmalık Diyetisyen']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
