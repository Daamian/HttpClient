<?php

namespace Daamian\HttpClient\Http;

use Daamian\HttpClient\Exception\HttpExecuteException;

interface HttpInterface
{

    public function setUrl(string $url): self;

    public function setMethod(string $method): self;

    public function setBody(string $body): self;

    public function addHeader(string $name, string $value): HttpInterface;

    /**
     * @throws HttpExecuteException When request failed
     */
    public function execute(): HttpResultInterface;
}
