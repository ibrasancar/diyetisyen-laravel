<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SosyalMedyaSeeder::class);
        $this->call(DiyetisyenTipSeeder::class);
        $this->call(DosyaSeeder::class);
        $this->call(KullaniciSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
