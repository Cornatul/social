<?php

return [
    'linkedin' => [
        'clientId' => env('LINKEDIN_CLIENT_ID', '775v6e6d8jut9w'),
        'clientSecret' => env('LINKEDIN_CLIENT_SECRET', '98s0hqmbuE8PURwc'),
        'redirectUri' => env('LINKEDIN_REDIRECT_URI', 'https://newsai.loc/social/linkedin/callback'),
    ],
    'github' => [
        'clientId' => env('GITHUB_CLIENT_ID', '775v6e6d8jut9w'),
        'clientSecret' => env('GITHUB_CLIENT_SECRET', '98s0hqmbuE8PURwc'),
        'redirectUri' => env('GITHUB_REDIRECT_URI', 'https://newsai.loc/social/github/callback'),
    ]
];
