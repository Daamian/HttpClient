<?php

namespace Daamian\HttpClient\Http;

use Daamian\HttpClient\Exception\HttpExecuteException;

class Curl implements HttpInterface
{

    private $handle = null;

    private ?int $statusCode = null;

    public function __construct()
    {
        $this->handle = curl_init();
    }

    public function setUrl(string $url): HttpInterface
    {
        curl_setopt($this->handle, CURLOPT_URL, $url);

        return $this;
    }

    public function setMethod(string $method): HttpInterface
    {
        curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, $method);

        return $this;
    }

    public function setBody(string $body): HttpInterface
    {
        curl_setopt($this->handle, CURLOPT_POSTFIELDS, $body);

        return $this;
    }

    public function setHeaders(array $headers): HttpInterface
    {
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, $headers);

        return $this;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * @inheritDoc
     */
    public function execute(): string
    {
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->handle, CURLOPT_FAILONERROR, true);
        $result = curl_exec($this->handle);
        $this->statusCode = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
        curl_close($this->handle);

        if (false === $result) {
            throw new HttpExecuteException("Execute http request is failed");
        }

        return $result;
    }


}
