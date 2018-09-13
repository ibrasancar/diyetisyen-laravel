<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYorumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yorum', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kullanici_id');
            $table->unsignedInteger('diyetisyen_id');
            $table->text('yorum');

            $table->timestamp('gonderme_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('silinme_tarihi')->nullable();

            $table->foreign('kullanici_id')->references('id')->on('kullanici')->onDelete('cascade');
            $table->foreign('diyetisyen_id')->references('id')->on('diyetisyen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yorum');
    }
}
