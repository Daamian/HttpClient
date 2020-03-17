<?php

namespace Daamian\HttpClient;

use Daamian\HttpClient\Authorization\AuthorizationInterface;
use Daamian\HttpClient\Authorization\NullAuthorization;
use Daamian\HttpClient\Exception\ClientException;
use Daamian\HttpClient\Exception\HttpExecuteException;
use Daamian\HttpClient\Exception\RequestException;
use Daamian\HttpClient\Http\HttpInterface;
use Daamian\HttpClient\Request\RequestChecker;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client implements ClientInterface
{

    private HttpInterface $http;

    private AuthorizationInterface $authorization;

    private RequestChecker $requestChecker;

    public function __construct(HttpInterface $http, RequestChecker $requestChecker)
    {
        $this->http = $http;
        $this->requestChecker = $requestChecker;
        $this->authorization = new NullAuthorization();
    }

    public function setAuthorization(AuthorizationInterface $authorization): void
    {
        $this->authorization = $authorization;
    }

    /**
     * @inheritDoc
     * @throws RequestException Exception for when Request is invalid
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        if (false === $this->requestChecker->check($request)) {
            throw new RequestException($request, $this->requestChecker->getMessage());
        }

        $this->buildHttp($request);

        try {
            $result = $this->http->execute();
        } catch (HttpExecuteException $exception) {
            throw new ClientException($exception->getMessage());
        }

        return new Response($result->getStatusCode(), $result->getHeaders(), $result->getBody());
    }


    private function buildHttp(RequestInterface $request): HttpInterface
    {
        $this->http->setUrl($request->getUri())
            ->setMethod($request->getMethod())
            ->setBody($request->getBody()->__toString());

        $this->initHeaders($request->getHeaders());
        $this->authorization->auth($this->http);

        return $this->http;
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
