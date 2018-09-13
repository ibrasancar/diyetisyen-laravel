<?php

use App\Models\SosyalMedya;
use Illuminate\Database\Seeder;

class SosyalMedyaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        SosyalMedya::truncate();
        for ($i=1; $i<41; $i++)
        {
            SosyalMedya::create([
               "kullanici_id"   =>  $i,
               "tip"    =>  "facebook",
               "deger"  => "#"
            ]);
            SosyalMedya::create([
                "kullanici_id"   =>  $i,
                "tip"    =>  "twitter",
                "deger"  => "#"
            ]);
            SosyalMedya::create([
                    "kullanici_id"   =>  $i,
                    "tip"    =>  "linkedin",
                    "deger"  => "#"
            ]);

        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
