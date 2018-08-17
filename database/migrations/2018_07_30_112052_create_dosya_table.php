<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosyaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosya', function (Blueprint $table) {
            $table->increments('id');
            /*
             * 0 -> avatar
             * 1 -> sertifika
             * 2 -> icerik
             */
            $table->unsignedTinyInteger('tip_id')->default(0);
            $table->string('tip', 50);
            $table->string('klasor', 100);
            $table->string('url', 100);
            $table->tinyInteger('is_down')->nullable();
            $table->timestamp('upload_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosya');
    }
}
