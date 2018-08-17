<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiyetisyenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diyetisyen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kullanici_id')->unsigned();
            /* DEĞERLER GİRİLECEK */
            $table->tinyInteger('tip');
            $table->decimal('puan', '2','1')->nullable();
            $table->text('aciklama')->nullable();
            $table->text('ozgecmis');

            $table->foreign('kullanici_id')->references('id')->on('kullanici')->onDelete('cascade');
            $table->foreign('tip')->references('tip')->on('diyetisyen_tip')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diyetisyen');
    }
}
