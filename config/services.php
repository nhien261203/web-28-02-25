<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [

        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],

    'vnpay' => [
        'tmn_code'    => env('VNP_TMN_CODE', 'R04CAIF6'),
        'hash_secret' => env('VNP_HASH_SECRET', 'IY1BW043BVONGBNI083QQL7GTFH830Y5'),
        'url'         => env('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
        'return_url'  => env('APP_URL') . '/payment-success',
        // $vnp_TmnCode = "R04CAIF6";
        // $vnp_HashSecret = "IY1BW043BVONGBNI083QQL7GTFH830Y5";
        // $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    ],

];
