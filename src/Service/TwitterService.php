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

    public function getAuthUrl(array $options = ['scope' => ['tweet.write']]): string
    {
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
