<?php

namespace Daamian\HttpClient\Authorization;

use Daamian\HttpClient\Http\HttpInterface;

class NullAuthorization implements AuthorizationInterface
{

    public function auth(HttpInterface $http): void
    {
    }
}
