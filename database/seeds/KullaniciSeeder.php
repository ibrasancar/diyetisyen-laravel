<?php

use App\Models\Diyetisyen;
use App\Models\Kullanici;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KullaniciSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Kullanici::truncate();
        Diyetisyen::truncate();
        for($i=0; $i<20; $i++)
        {
            $kullanici = Kullanici::create([
                "seviye" => 0,
                "kullanici_adi" => $faker->unique()->userName,
                "sifre"         =>  bcrypt('123456'),
                "email"        => $faker->unique()->safeEmail,
                "ad_soyad"      => $faker->name,
                "telefon"       => $faker->phoneNumber,
                "cep_telefon"   => $faker->phoneNumber,
                "adres"         => $faker->city,
                "resim_id"      => 1,
                "tc_no"         => $faker->tcNo,
                "dogum_tarihi"  => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);

            $kullanici->diyetisyen()->create([
                "tip"   =>  rand(1,7),
                "puan"  => null,
                "ozgecmis"  => $faker->sentence(160),
                "aciklama"  => $faker->sentence(20)
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}