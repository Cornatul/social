<?php

return [
    'linkedin' => [
        'clientId' => env('LINKEDIN_CLIENT_ID', ''),
        'clientSecret' => env('LINKEDIN_CLIENT_SECRET', ''),
        'redirectUri' => env('LINKEDIN_REDIRECT_URI', ''),
    ],

    'twitter' => [
        'clientId' => env('TWITTER_CLIENT_ID', ''),
        'clientSecret' => env('TWITTER_CLIENT_SECRET', ''),
        'redirectUri' => env('TWITTER_REDIRECT_URI', ''),
    ],

    'github' => [
        'clientId' => env('GITHUB_CLIENT_ID', ''),
        'clientSecret' => env('GITHUB_CLIENT_SECRET', ''),
        'redirectUri' => env('GITHUB_REDIRECT_URI', ''),
    ],
];
