<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesajTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesaj', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('onceki_mesaj_id')->unsigned()->nullable();
            $table->integer('gonderici_id')->unsigned();
            $table->integer('alici_id')->unsigned();
            $table->integer('dosya_id')->unsigned()->nullable();

            $table->string('baslik', 255);
            $table->text('mesaj');

            $table->timestamp('gonderme_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('silinme_tarihi')->nullable();
            $table->dateTime('okunma_tarihi')->nullable();

            $table->foreign('gonderici_id')->references('id')->on('kullanici')->onDelete('cascade');
            $table->foreign('alici_id')->references('id')->on('kullanici')->onDelete('cascade');
            $table->foreign('dosya_id')->references('id')->on('dosya')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesaj');
    }
}
