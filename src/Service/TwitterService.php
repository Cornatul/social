<?php
declare(strict_types=1);

namespace Cornatul\Social\Service;

use Cornatul\Social\Contracts\ShareContract;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Smolblog\OAuth2\Client\Provider\Twitter;

class TwitterService implements ShareContract
{
    private Twitter $provider;

    private string $code_verifier;

    public function __construct(Twitter $provider)
    {
        $this->provider = $provider;
        $this->code_verifier = $this->provider->generatePkceVerifier();

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
            ],
            'code_challenge' => $this->provider->generatePkceVerifier(),
            'code_challenge_method' => 'S256'
        ];

        return $this->provider->getAuthorizationUrl($options);
    }


    /**
     * @throws IdentityProviderException
     */
    public function getAccessToken($code): AccessTokenInterface
    {
        return $this->provider->getAccessToken('authorization_code', [
            'code' => $code,
            'code_verifier' => $this->provider->generatePkceVerifier(),
        ]);
    }

   public function shareOnWall(string $accessToken, string $message)
    {
        return $this->provider->post('1.1/statuses/update.json', [
            'access_token' => $accessToken,
            'status' => $message,
        ]);
    }
}
