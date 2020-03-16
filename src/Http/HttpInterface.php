<?php

namespace Daamian\HttpClient\Http;

use Daamian\HttpClient\Exception\HttpExecuteException;

interface HttpInterface
{

    public function setUrl(string $url): self;

    public function setMethod(string $method): self;

    public function setBody(string $body): self;

    public function setHeaders(array $headers): self;

    public function getStatusCode(): ?int;

    /**
     * @throws HttpExecuteException When request failed
     */
    public function execute(): string;


}
