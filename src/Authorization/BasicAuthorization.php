<?php

namespace Daamian\HttpClient\Authorization;

class BasicAuthorization implements AuthorizationInterface
{

    private string $username;

    private string $password;

    public function __construct(string $username, string $password)
    {
    }

    public function auth(): void
    {
        // TODO: Implement auth() method.
    }

}
