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

    'google' => [
        'client_id' => '163434374156-1bnf02flrbviuplfb4rc2tp3kqg4p837.apps.googleusercontent.com',
        'client_secret' => 'BHuXH2wTarQi1nsskrBUXypd',
        'redirect' => 'http://localhost/callback/google',
    ],

    'facebook' => [
        'client_id' => '158121739091971',
        'client_secret' => '1f76d8e5017cb95daa49478dcb818a27',
        'redirect' => 'http://localhost/callback/facebook',
    ],

    'zalo' => [
        'client_id' => '4302442031182802619',
        'client_secret' => 'DD16D58PRcELUiE41BYq',
        'redirect' => 'http://localhost/callback/zalo',
    ],
];
