<?php

namespace Daamian\HttpClient\Http;

use Daamian\HttpClient\FactoryInterface;

class CurlFactory implements FactoryInterface
{

    public static function create(): Curl
    {
        return new Curl();
    }

}
