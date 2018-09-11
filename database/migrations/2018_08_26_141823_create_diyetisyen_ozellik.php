<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiyetisyenOzellik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diyetisyen_ozellik', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('diyetisyen_id');
            $table->tinyInteger('anasayfa_goster');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diyetisyen_ozellik');
    }
}
