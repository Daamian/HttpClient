<?php

namespace Daamian\HttpClient;

use Daamian\HttpClient\Authorization\AuthorizationInterface;
use Daamian\HttpClient\Authorization\NullAuthorization;
use Daamian\HttpClient\Http\HttpInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;

class Client implements ClientInterface
{

    private HttpInterface $http;

    private AuthorizationInterface $authorization;

    public function __construct(HttpInterface $http)
    {
        $this->http = $http;
        $this->authorization = new NullAuthorization();
    }

    public function setAuthorization(AuthorizationInterface $authorization): void
    {
        $this->authorization = $authorization;
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->http->setUrl($request->getUri())
            ->setMethod($request->getMethod())
            ->setBody($request->getBody()->__toString());

        $this->initHeaders($request->getHeaders());
        $this->authorization->auth($this->http);
        $result = $this->http->execute();

        return new Response($this->http->getStatusCode(), [], $result);
    }


    private function initHeaders(array $headers): void
    {
        foreach ($headers as $header => $values) {
            foreach ($values as $value) {
                $this->http->addHeader($header, $value);
            }
        }
    }

}
