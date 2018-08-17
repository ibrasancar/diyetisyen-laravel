<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogKayitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_kayit', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kullanici_id');
            $table->string('ip_adresi', 100);

            $table->timestamp('giris_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('cikis_tarihi')->nullable();

            $table->foreign('kullanici_id')->references('id')->on('kullanici')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_kayit');
    }
}
