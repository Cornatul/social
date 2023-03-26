<?php
declare(strict_types=1);

namespace Cornatul\Social\Service;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Provider\LinkedIn;
use Smolblog\OAuth2\Client\Provider\Twitter;

class TwitterService
{
    private Twitter $provider;

    public function __construct(Twitter $provider)
    {
        $this->provider = $provider;
    }

    public function getAuthUrl(): string
    {
        $options = [
            'scope' => [
                'tweet.read',
                'tweet.write',
                'tweet.moderate.write',
                'users.read',
                'follows.read',
                'follows.write',
                'offline.access',
                'space.read',
                'mute.read',
                'mute.write',
                'like.read',
                'like.write',
                'list.read',
                'list.write',
                'block.read',
                'block.write',
                'bookmark.read',
                'bookmark.write'
            ]
        ];

        return $this->provider->getAuthorizationUrl($options);
    }


    public function getAccessToken($code)
    {
        return $this->provider->getAccessToken('authorization_code', [
            'code' => $code,
            'code_verifier' => $this->provider->getPkceVerifier(),
        ]);
    }

   public function shareOnWall($accessToken, $message)
    {
        //share on twitter
        return $this->provider->post('1.1/statuses/update.json', [
            'access_token' => $accessToken,
            'status' => $message,
        ]);
    }
}
