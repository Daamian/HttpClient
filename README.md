# HttpClient

Simple http client

## Installation

It's recommended that you use [Composer](https://getcomposer.org/) to install HttpClient

```bash
$ composer require daamian/http-client
```

This will install HttpClient and all required dependencies. Slim requires PHP 7.4 or newer.

## Example

GET request

```php
<?php

use Daamian\HttpClient\Authorization\BasicAuthorization;
use Daamian\HttpClient\ClientFactory;
use Nyholm\Psr7\Request;

$request = new Request(
    'GET',
    'http://jsonplaceholder.typicode.com/posts'
);

$client = ClientFactory::create();
$client->setAuthorization(new BasicAuthorization('user', 'password'));
$response = $client->sendRequest($request);

// ...
```

POST request

```php
<?php

use Daamian\HttpClient\Authorization\BasicAuthorization;
use Daamian\HttpClient\ClientFactory;
use Nyholm\Psr7\Request;

$request = new Request(
    'POST',
    'http://jsonplaceholder.typicode.com/posts',
    ['Content-Type' => 'application/json'],
    json_encode(['title' => 'test5555'])
);


$client = ClientFactory::create();
$client->setAuthorization(new BasicAuthorization('user', 'password'));
$response = $client->sendRequest($request);

// ...
```

PUT request

```php
<?php

use Daamian\HttpClient\Authorization\BasicAuthorization;
use Daamian\HttpClient\ClientFactory;
use Nyholm\Psr7\Request;

$request = new Request(
    'PUT',
    'http://jsonplaceholder.typicode.com/posts/1',
    ['Content-Type' => 'application/json'],
    json_encode(['title' => 'test5555'])
);


$client = ClientFactory::create();
$client->setAuthorization(new BasicAuthorization('user', 'password'));
$response = $client->sendRequest($request);

// ...
```


