<?php

use App\Models\Paket;
use Illuminate\Database\Seeder;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Paket::truncate();
        Paket::create([
            'tanim' =>  '1 Aylık',
            'icerik' => $faker->sentence(24),
            'ucret'  => 39.99
        ]);
        Paket::create([
            'tanim' =>  '6 Aylık',
            'icerik' => $faker->sentence(24),
            'ucret'  => 199.99
        ]);
        Paket::create([
            'tanim' =>  '12 Aylık',
            'icerik' => $faker->sentence(24),
            'ucret'  => 249.99
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
