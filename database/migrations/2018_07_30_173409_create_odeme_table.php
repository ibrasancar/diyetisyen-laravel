<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odeme', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kullanici_id');
            $table->unsignedInteger('paket_id');
            $table->tinyInteger('metot');
            $table->decimal('miktar', 6,2);

            $table->timestamp('odeme_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('kullanici_id')->references('id')->on('kullanici')->onDelete('cascade');
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('odeme');
    }
}
