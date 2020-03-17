<?php

namespace Daamian\HttpClient;

use Daamian\HttpClient\Http\Curl\CurlFactory;
use Daamian\HttpClient\Request\RequestCheckerFactory;
use Psr\Http\Client\ClientInterface;

class ClientFactory implements FactoryInterface
{

    public static function create(): ClientInterface
    {
        return new Client(CurlFactory::create(), RequestCheckerFactory::create());
    }
}
