<?php

namespace Daamian\HttpClient;

use Daamian\HttpClient\Http\Curl;
use Daamian\HttpClient\Http\HttpInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;

class Client implements ClientInterface
{

    private HttpInterface $http;

    public function __construct(HttpInterface $http)
    {
        $this->http = $http;
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $result = $this->http->setUrl($request->getUri())
            ->setMethod($request->getMethod())
            ->setBody($request->getBody()->__toString())
            ->setHeaders($this->mapHeaders($request->getHeaders()))
            ->execute();

        return new Response($this->http->getStatusCode(), [], $result);
    }


    private function mapHeaders(array $headers): array
    {
        $mappedHeader = [];
        foreach ($headers as $header => $values) {
            foreach ($values as $value) {
                $mappedHeader[] = $header.':'.$value;
            }
        }

        return $mappedHeader;
    }

}
