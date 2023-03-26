<?php

namespace Cornatul\Social\Contracts;

interface ShareContract
{
    //@todo change the message to not be a string but a array or a class object
    public function shareOnWall(string $accessToken, string $message): void;
}
