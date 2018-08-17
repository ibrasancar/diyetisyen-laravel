<?php

use Illuminate\Database\Seeder;

class DosyaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('dosya')
            ->insert(['tip_id' => 0, 'tip' => 'avatar', 'klasor' => 'uploads/avatar', 'url' => 'default.jpg']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
