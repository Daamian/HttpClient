<?php

namespace Daamian\HttpClient\Http;

use Daamian\HttpClient\Exception\HttpExecuteException;

class Curl implements HttpInterface
{

    private $handle = null;

    private array $headers = [];

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

    public function addHeader(string $name, string $value): HttpInterface
    {
        $this->headers[] = $name.':'.$value;

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
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->handle, CURLOPT_FAILONERROR, true);
        $result = curl_exec($this->handle);
        $this->statusCode = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);

        if (false === $result) {
            throw new HttpExecuteException(curl_error($this->handle));
        }

        curl_close($this->handle);

        return $result;
    }
}
