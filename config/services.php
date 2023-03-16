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
    'github' => [
        'client_id' => '24fbd0edd46019058da7', //Github API
        'client_secret' => '4500e6ab7a9bb70608600fbdee37969276bb0685', //Github Secret
        'redirect' => 'http://localhost:8000/login/github/callback',
     ],
     'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_APP_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT'),
     ],
     'facebook' => [
        'client_id' => '1494792524037846', //Facebook API
        'client_secret' => '1bf13c2faf680f4ae2b97bdafa92c7d2', //Facebook Secret
        'redirect' => 'http://localhost:8000/login/facebook/callback',
     ],

];

/*

GOOGLE_CLIENT_ID=405488045949-f23v9gdb3cdtqj9lq3nqeji128ck5hr9.apps.googleusercontent.com
GOOGLE_APP_SECRET=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
GOOGLE_REDIRECT=http://127.0.0.1:8000/login/google/callback
*/
