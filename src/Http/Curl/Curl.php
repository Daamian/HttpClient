<?php

namespace Daamian\HttpClient\Http\Curl;

use Daamian\HttpClient\Exception\HttpExecuteException;
use Daamian\HttpClient\Http\HttpInterface;
use Daamian\HttpClient\Http\HttpResultInterface;

class Curl implements HttpInterface
{

    private $handle = null;

    private array $headers = [];

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

    /**
     * @inheritDoc
     */
    public function execute(): HttpResultInterface
    {
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->handle, CURLOPT_FAILONERROR, true);
        curl_setopt($this->handle, CURLOPT_HEADER, 1);
        $result = curl_exec($this->handle);

        if (false === $result) {
            throw new HttpExecuteException(curl_error($this->handle));
        }

        $result = $this->createResult($result);

        curl_close($this->handle);

        return $result;
    }

    private function createResult(string $result): CurlResult
    {
        $statusCode = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($this->handle, CURLINFO_HEADER_SIZE);
        $headers = $this->prepareHeaders($headerSize, $result);
        $body = substr($result, $headerSize);

        return new CurlResult($statusCode, $body, $headers);
    }

    private function prepareHeaders(int $headerSize, string $result): array
    {
        $headers = explode("\r\n", substr($result, 0, $headerSize));

        $preparedHeaders = [];

        foreach ($headers as $header) {
            $explodedHeader = explode(':', $header);
            if (true === isset($explodedHeader[0]) && true === isset($explodedHeader[1])) {
                $preparedHeaders[trim($explodedHeader[0])] = trim($explodedHeader[1]);
            }
        }

        return $preparedHeaders;
    }
}
