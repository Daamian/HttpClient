<?php

namespace Daamian\HttpClient\Authorization;

use Daamian\HttpClient\Http\HttpInterface;

interface AuthorizationInterface
{

    public function auth(HttpInterface $http): void;

}
