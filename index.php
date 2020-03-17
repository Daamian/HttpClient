<?php

use Daamian\HttpClient\Authorization\BasicAuthorization;
use Daamian\HttpClient\ClientFactory;
use Nyholm\Psr7\Request;

require_once "vendor/autoload.php";

$request = new Request(
    'POST',
    'http://jsonplaceholder.typicode.com/posts',
    ['Content-Type' => 'application/json'],
    json_encode(['title' => 'test5555'])
);

/*$request = new Request(
    '',
    ''
);*/

$client = ClientFactory::create();
$client->setAuthorization(new BasicAuthorization('user', 'password'));
var_dump($client->sendRequest($request)->getBody()->__toString());
