<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSertifikaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sertifika', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kullanici_id');
            $table->unsignedTinyInteger('tip_id');
            $table->text('icerik');
            $table->string('dosya_url', 255);

            $table->foreign('kullanici_id')->references('id')->on('kullanici')->onDelete('cascade');
            $table->foreign('tip_id')->references('tip')->on('sertifika_tip')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sertifika');
    }
}
