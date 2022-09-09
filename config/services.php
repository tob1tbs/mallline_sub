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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '435205588210356',
        'client_secret' => 'f847a3e3e7ebb4030471a287748f0856',
        'redirect' => 'https://mallline.ge/facebook/callback',
    ],
    'google' => [
        'client_id'     => '695999306161-rqu5o31mlfbcb9i855vask4f2f1vmk97.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => 'https://mallline.ge/google/callback',
    ],

];
