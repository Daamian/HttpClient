<?php

namespace Daamian\HttpClient\Authorization;

use Daamian\HttpClient\Http\HttpInterface;

class BasicAuthorization implements AuthorizationInterface
{

    private string $username;

    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function auth(HttpInterface $http): void
    {
        $http->addHeader('Authorization', 'Basic '.base64_encode("$this->username:$this->password"));
    }
}
