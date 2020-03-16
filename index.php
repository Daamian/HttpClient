<?php

use Daamian\HttpClient\Client;
use Nyholm\Psr7\Request;

require_once "vendor/autoload.php";

$request = new Request(
    'POST',
    'http://jsonplaceholder.typicode.com/posts',
    ['Content-Type' => 'application/json'],
    json_encode(['title' => 'test5555'])
);

$client = new Client(new \Daamian\HttpClient\Http\Curl());
var_dump($client->sendRequest($request)->getBody()->__toString());
