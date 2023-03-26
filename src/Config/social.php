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
    ],
    'instagram' => [
        'clientId' => env('INSTAGRAM_CLIENT_ID', '1674476439672879'),
        'clientSecret' => env('INSTAGRAM_CLIENT_SECRET', 'fede7797b337e274b3f824f6f61ca12f'),
        'redirectUri' => env('INSTAGRAM_REDIRECT_URI', 'https://newsai.loc/social/instagram/callback'),
    ],
    'twitter' => [
        'clientId' => env('TWITTER_CLIENT_ID', 'YVVDYUNja2w3Uk5FNlFXc05SQW06MTpjaQ'),
        'clientSecret' => env('TWITTER_CLIENT_SECRET', 'NdsFfmzgmuxhNVpKSGOErk8k8zIie8U05VGHM5ITFUgzKp6_mt'),
        'redirectUri' => env('TWITTER_REDIRECT_URI', 'https://newsai.loc/social/twitter/callback'),
    ]
];
