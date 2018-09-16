<?php

use App\Models\Mesaj;
use Illuminate\Database\Seeder;

class MesajSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Mesaj::truncate();
        for ($i = 0; $i <= 200; $i++)
        {
            $diyetisyen_mi = rand(0,1);
            $okundu_mu = rand(0,1);
            $kullanici = Mesaj::create([
                'onceki_mesaj_id'   =>  rand(0,1) == 0 ? rand(1, 100) : 0,
                'gonderici_id'      =>  $diyetisyen_mi == 0 ? rand(1, 20) : rand(21, 40),
                'alici_id'          =>  $diyetisyen_mi == 0 ? rand(21, 40) : rand(1,20),
                'baslik'            =>  $faker->sentence(12),
                'mesaj'             =>  $faker->sentence(250),
                'gonderme_tarihi'   =>  $faker->dateTime($max = 'now'),
                'okunma_tarihi'     =>  $okundu_mu == 0 ? null : $faker->dateTime($max = 'now')
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
