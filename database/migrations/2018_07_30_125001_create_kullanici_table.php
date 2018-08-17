<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKullaniciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kullanici', function (Blueprint $table) {
            $table->increments('id');

            /*
             * 0 -> Normal Kullanıcı
             * 1 -> Diyetisyen
             * 2 -> Mod
             * 3 -> Yönetici
             */
            $table->tinyInteger('seviye')->default(0);

            $table->string('kullanici_adi', 50);
            $table->string('sifre', 60);
            $table->string('email', 70);
            $table->string('ad_soyad', 50);
            $table->string('telefon', 30)->nullable();
            $table->string('cep_telefon', 30);
            $table->string('adres')->nullable();
            #resim bilgisi - avatar bilgisi
            $table->integer('resim_id')->unsigned()->nullable();
            $table->string('tc_no', 11);
            $table->date('dogum_tarihi');
            $table->rememberToken();
            #kullanıcı tarih değerleri
            $table->timestamp('olusturma_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('guncelleme_tarihi')->default(DB::raw('CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('silinme_tarihi')->nullable();

            #resim bilgisi
            $table->foreign('resim_id')->references('id')->on('dosya')->onDelete('cascade');
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
