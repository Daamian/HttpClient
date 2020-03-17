<?php

use Daamian\HttpClient\Authorization\BasicAuthorization;
use Daamian\HttpClient\ClientFactory;
use Nyholm\Psr7\Request;

require_once "vendor/autoload.php";

$request = new Request(
    'PUT',
    'http://jsonplaceholder.typicode.com/posts/1',
    ['Content-Type' => 'application/json'],
    json_encode(['title' => 'test5555'])
);

$client = ClientFactory::create();
$client->setAuthorization(new BasicAuthorization('user', 'password'));
$response = $client->sendRequest($request)->getBody()->__toString();
var_dump($response);
exit();
