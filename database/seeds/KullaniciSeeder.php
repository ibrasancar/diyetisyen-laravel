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
                "seviye" => 1,
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
        }
        for($i=0; $i<40; $i++)
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
        }
        for($i=1; $i<=20; $i++)
        {
            $diyetisyen = Diyetisyen::create([
                "kullanici_id"    =>  $i,
                "tip"   =>  rand(1,7),
                "puan"  => 3,
                "ozgecmis"  => $faker->sentence(160),
                "aciklama"  => $faker->sentence(20)
            ]);
        }
        Kullanıcı::create([
            "seviye"    =>  0,
            "kullanici_adi" => "demokullanici",
            "sifre"         =>  bcrypt('123456'),
            "email"         => "demo@demo.com",
            "ad_soyad"      => $faker->name,
            "telefon"       => $faker->phoneNumber,
            "cep_telefon"   => $faker->phoneNumber,
            "adres"         => $faker->city,
            "resim_id"      => 1,
            "tc_no"         => $faker->tcNo,
            "dogum_tarihi"  => $faker->date($format = 'Y-m-d', $max = 'now'),
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
