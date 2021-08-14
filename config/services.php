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
        'client_id' => '323768015643-78loc81d0omcem5t4kjk2d5dmb321ams.apps.googleusercontent.com',
        'client_secret' => 'MedBVoPkBmCPEV_dz-iJ3La1',
        'redirect' => '/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '350240226474052',
        'client_secret' => '211114c68f5656a73a1cfea5cb8e53ff',
        'redirect' => '/auth/facebook/callback',
    ],

];
