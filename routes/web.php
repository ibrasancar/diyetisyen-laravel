<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'SayfaController@index')->name('anasayfa');

Route::group(['prefix' => 'kullanici'], function (){

    # Giriş, Çıkış ve Kayıt İşlemleri Route
        Route::get('/giris', 'AuthController@giris')->name('kullanici.giris');
        Route::post('/giris', 'AuthController@giris_islem');
        Route::get('/kayit', 'AuthController@kayit')->name('kullanici.kayit');
        Route::post('/kayit', 'AuthController@kayit_islem');
        Route::get('/cikis', 'AuthController@cikis')->name('kullanici.cikis');

    #Kullanıcı işlemleri
        #Kullanıcı hesap ayarları route
        Route::get('/panel', 'KullaniciController@panel')->name('kullanici.panel');
        Route::post('/panel', 'KullaniciController@guncelle');

        #Diyetisyen hesap ayarları route
        Route::get('/panel/diyetisyen', 'KullaniciController@diyetisyen_panel')->name('kullanici.diyetisyen_panel');
        Route::post('/panel/diyetisyen', 'KullaniciController@diyetisyen_guncelle');

        #Kullanıcı resim ayarı route
        Route::get('/avatar', 'KullaniciController@avatar')->name('kullanici.avatar');
        Route::post('/avatar', 'KullaniciController@avatar_guncelle');

});

Route::group(['prefix' => 'mesaj', 'middleware' => 'auth'], function () {
    #Mesaj paneli route
        #Gelen mesajların kontrolü
        Route::get('/', 'MesajController@alinan_mesajlar')->name('mesaj.alinanlar');
        #Giden mesajların kontrolü
        Route::get('/giden', 'MesajController@gonderilen_mesajlar')->name('mesaj.gonderilenler');
        #Mesaj oku
        Route::get('/incele/{mesaj_id}', 'MesajController@incele')->name('mesaj.incele');
        #Mesaj yazma arayüzü
        Route::get('/gonder/{alici_id}/{onceki_mesaj_id?}', 'MesajController@yaz')->name('mesaj.yaz');
        #Mesaj gönderme
        Route::post('/gonder', 'MesajController@gonder')->name('mesaj.gonder');
        #Mesaj sil
        Route::post('/sil', 'MesajController@sil')->name('mesaj.sil');
});

Route::group(['prefix' => 'diyetisyen', 'middleware' => 'auth'], function (){

    Route::match(['get', 'post'], '/', 'DiyetisyenController@index')->name('diyetisyen');
    Route::get('/{kullanici_adi}', 'DiyetisyenController@incele')->name('diyetisyen.incele');
    Route::get('/{kullanici_adi}/yorum', 'YorumController@yorum_sayfa')->name('diyetisyen.yorum_sayfa');
    Route::post('/{kullanici_adi}/yorum', 'YorumController@yorum_yap');

});

