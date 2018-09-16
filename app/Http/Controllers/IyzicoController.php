<?php

namespace App\Http\Controllers;


class IyzicoController extends Controller
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey("sandbox-NUuIGXI6opaf6tzVfuU1fdzCCTuVA5uz");
        $options->setSecretKey("sandbox-3hVYxwH5FsANksvO4CE6BSVeBNOLBM26");
        $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        return $options;
    }
}
