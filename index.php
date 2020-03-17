<?php

use Daamian\HttpClient\Client;
use Nyholm\Psr7\Request;
use Daamian\HttpClient\Authorization\BasicAuthorization;

require_once "vendor/autoload.php";

$request = new Request(
    'POST',
    'http://jsonplaceholder.typicode.com/posts',
    ['Content-Type' => 'application/json'],
    json_encode(['title' => 'test5555'])
);

$client = new Client(new \Daamian\HttpClient\Http\Curl());
$client->setAuthorization(new BasicAuthorization('user', 'password'));
var_dump($client->sendRequest($request)->getBody()->__toString());
