<?php


namespace Daamian\HttpClient\Request;

use Daamian\HttpClient\FactoryInterface;

class RequestCheckerFactory implements FactoryInterface
{

    public static function create(): RequestChecker
    {
        return new RequestChecker();
    }
}
