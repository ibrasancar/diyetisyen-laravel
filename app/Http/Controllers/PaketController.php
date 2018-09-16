<?php

namespace App\Http\Controllers;

use App\Models\Diyetisyen;
use App\Models\DiyetisyenTip;
use App\Models\Kullanici;
use App\Models\Mesaj;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;



class PaketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $ku_id = Auth::user()->id;
            $okunmamis_mesaj_sayisi = Mesaj::where('mesaj.alici_id', $ku_id)->where('mesaj.okunma_tarihi', null)->count();
            View::share('okunmamis_mesaj_sayisi', $okunmamis_mesaj_sayisi);

            return $next($request);
        });
    }

    public function diyetisyen_kayit()
    {
        $kullanici_id = \auth()->user()->id;

        $kullanici = Kullanici::with('diyetisyen')->where('id', $kullanici_id)->firstOrFail();

        if ($kullanici->seviye == 1)
        {
            $mesaj = "Üyeliğiniz hala aktif durumdadır. Üyelik süreniz dolduktan sonra ödeme yapabilirsiniz.";
            $mesaj_tur = "info";
        }

        $paketler = Paket::all();
        return view('paket.diyetisyen_kayit', compact('kullanici', 'paketler', 'mesaj', 'mesaj_tur'));
    }

    public function satin_al(Request $http_req, $paket_id)
    {
        $kullanici_id = \auth()->user()->id;

        $kullanici = Kullanici::with('diyetisyen')->where('id', $kullanici_id)->firstOrFail();

        if ($kullanici->seviye == 1)
        {
            return redirect()->route('anasayfa')
                ->with('mesaj_tur', 'info')
                ->with('mesaj', 'Üyeliğiniz hala aktif durumdadır. Süreniz dolduktan sonra ödeme yapınız.');
        }
        $paket =  Paket::where('id', $paket_id)->firstOrFail();


        $request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId("123456789");
        $request->setPrice($paket->ucret);
        $request->setPaidPrice($paket->ucret);
        $request->setCurrency(\Iyzipay\Model\Currency::TL);
        $request->setBasketId("B67832");
        $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $request->setCallbackUrl(route('paket.odeme_sonucu'));
        $request->setEnabledInstallments(array(2, 3, 6, 9));

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($kullanici->id);
        $buyer->setName("John"); //ayarlanacak
        $buyer->setSurname("Doe"); //ayarlanacak
        $buyer->setGsmNumber("$kullanici->cep_telefon");
        $buyer->setEmail("$kullanici->email");
        $buyer->setIdentityNumber("$kullanici->tc_no");
        $buyer->setRegistrationDate("$kullanici->olusturma_tarihi");
        $buyer->setRegistrationAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1"); //ayarlancak
        $buyer->setIp($http_req->ip());
        $buyer->setCity("Istanbul");//ayarlanacak
        $buyer->setCountry("Turkey");
        $buyer->setZipCode("34732");

        $request->setBuyer($buyer);
        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName("$kullanici->ad_soyad");
        $shippingAddress->setCity("Istanbul"); // ayarlanacak
        $shippingAddress->setCountry("Turkey"); // ayarlanacak
        $shippingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1"); //ayarlanacak
        $shippingAddress->setZipCode("34742"); //ayarlanacak
        $request->setShippingAddress($shippingAddress);

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName("$kullanici->ad_soyad");
        $billingAddress->setCity("Istanbul"); //ayarlanacak
        $billingAddress->setCountry("Turkey"); //ayarlanacak
        $billingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1"); //ayarlanacak
        $billingAddress->setZipCode("34742"); //ayarlanacak
        $request->setBillingAddress($billingAddress);

        $basketItems = array();
        $firstBasketItem = new \Iyzipay\Model\BasketItem();
        $firstBasketItem->setId($paket->id);
        $firstBasketItem->setName($paket->tanim);
        $firstBasketItem->setCategory1($paket->tanim);
        $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
        $firstBasketItem->setPrice($paket->ucret);
        $basketItems[0] = $firstBasketItem;

        $request->setBasketItems($basketItems);

        $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, IyzicoController::options());

        $diyetisyeni_tipleri = DiyetisyenTip::all();
        return view('paket.satin_al', compact('paket', 'kullanici', 'diyetisyeni_tipleri', 'checkoutFormInitialize'));


    }

    public function odeme_sonucu(Request $token)
    {
        $kullanici_id = \auth()->user()->id;

        $kullanici = Kullanici::with('diyetisyen')->where('id', $kullanici_id)->firstOrFail();

        $request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId("123456789");
        $request->setToken($token->token);

        $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, IyzicoController::options());

        if ($checkoutForm->getPaymentStatus() == 'SUCCESS')
        {
            Diyetisyen::create([
                'kullanici_id'  =>  $kullanici->id,
                'tip'           =>  1,
                'puan'          =>  3,
                'aciklama'      =>  'Doldurulacak',
                'ozgecmis'      =>  'Doldurulacak'
            ]);
            $kullanici->seviye = 1;
            $kullanici->save();
        }

        return view('paket.odeme_sonucu', compact('kullanici', 'checkoutForm'));
    }
}
