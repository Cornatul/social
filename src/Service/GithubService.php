<?php
declare(strict_types=1);

namespace Cornatul\Social\Service;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Provider\LinkedIn;

class GithubService
{
    private Github $provider;

    public function __construct(Github $provider)
    {
        $this->provider = $provider;
    }

    public function getAuthUrl(array $options = ['scope' => ['gist']]): string
    {
        return $this->provider->getAuthorizationUrl($options);
    }

    /**
     * @throws IdentityProviderException
     */
    public function getAccessToken($code)
    {
        return $this->provider->getAccessToken('authorization_code', [
            'code' => $code,
        ]);
    }

    public function createGist($accessToken, $message)
    {
        $client = $this->provider->getAuthenticatedClient($accessToken);

        $response = $client->post('gists', [
            'body' => json_encode([
                'description' => 'Gist created from Laravel Social Package',
                'public' => true,
                'files' => [
                    'social.txt' => [
                        'content' => $message,
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
        ]);

    }
}
