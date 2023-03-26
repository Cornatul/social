<?php
declare(strict_types=1);

namespace Cornatul\Social\Service;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\LinkedIn;

class LinkedInService
{
    private LinkedIn $provider;

    public function __construct(LinkedIn $provider)
    {
        $this->provider = $provider;
    }

    public function getAuthUrl()
    {
        $options = [
            'state' => bin2hex(random_bytes(16)),
            'scope' => 'r_liteprofile w_member_social',
        ];

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

    public function shareOnWall($accessToken, $message)
    {
        $client = $this->provider->getAuthenticatedClient($accessToken);
        $body = [
            'author' => 'urn:li:person:me',
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => $message,
                    ],
                    'shareMediaCategory' => 'NONE',
                ],
            ],
            'visibility' => [
                'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
            ],
        ];
        $response = $client->post('ugcPosts', $body);

        return $response->getStatusCode() === 201;
    }
}
