<?php


namespace Daamian\HttpClient\Authorization;

use Daamian\HttpClient\Http\HttpInterface;

class JwtAuthorization implements AuthorizationInterface
{

    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function auth(HttpInterface $http): void
    {
        $http->addHeader('Authorization', 'Bearer '.$this->token);
    }

}
