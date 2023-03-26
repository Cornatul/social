<?php

return [
    'linkedin' => [
        'clientId' => env('LINKEDIN_CLIENT_ID', ''),
        'clientSecret' => env('LINKEDIN_CLIENT_SECRET', ''),
        'redirectUri' => env('LINKEDIN_REDIRECT_URI', ''),
    ],
    'twitter' => [
        'consumerKey' => env('TWITTER_CONSUMER_KEY', ''),
        'consumerSecret' => env('TWITTER_CONSUMER_SECRET', ''),
        'accessToken' => env('TWITTER_ACCESS_TOKEN', ''),
        'accessTokenSecret' => env('TWITTER_ACCESS_TOKEN_SECRET', ''),
        'apiVersion' => env('TWITTER_API_VERSION', '1.1'),
    ],

    'github' => [
        'clientId' => env('GITHUB_CLIENT_ID', ''),
        'clientSecret' => env('GITHUB_CLIENT_SECRET', ''),
        'redirectUri' => env('GITHUB_REDIRECT_URI', ''),
    ],
];
