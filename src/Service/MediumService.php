<?php
declare(strict_types=1);
namespace Cornatul\Social\Service;

use Cornatul\Social\Contracts\ShareContract;
use JonathanTorres\MediumSdk\Medium;
use League\OAuth2\Client\Token\AccessTokenInterface;

class MediumService
{
    public function shareOnWall(string $message)
    {
        $medium = new Medium();

        $medium->connect(config('social.medium.token'));

        $user = $medium->getAuthenticatedUser();

        $data = [
            'title' => 'Post title',
            'contentFormat' => 'html',
            'content' => 'This is my post content.',
            'publishStatus' => 'draft',
        ];

        return $medium->createPost($user->data->id, $data);

    }
}
