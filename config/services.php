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
        'client_id' => '707228700955706',
        'client_secret' => 'f5e12823568ad2af22496211dc315a45',
        'redirect' => 'https://kedker.com/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '920920676687-6e1kesnt3rqmfhf7d5cvff8eerkgkh4i.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://kedker.com/auth/google/callback',
    ],
    

];
