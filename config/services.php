<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '839398922572-flm9evnacsjmb3qajbv04imanj1pnb0j.apps.googleusercontent.com',
        'client_secret' => 'LogwFno3ts1SV3OEEzjiRcT9',
        'redirect' => 'http://localhost.utube.com/login/google/callback',
    ],

    'firebase' => [
        'api_key' => 'AIzaSyBKAG9IywFCNynRMLf9Qg_xMQn-Ynk8dEA', // Only used for JS integration
        'auth_domain' => 'utube-164b3.firebaseapp.com', // Only used for JS integration
        'database_url' => 'https://utube-164b3.firebaseio.com',
        'secret' => 'DATABASE_SECRET',
        'storage_bucket' => 'utube-164b3.appspot.com', // Only used for JS integration
    ],

];
