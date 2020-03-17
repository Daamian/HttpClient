<?php

namespace Daamian\HttpClient\Http;

interface HttpResultInterface
{

    public function getStatusCode(): int;

    public function getBody(): string;

    public function getHeaders(): array;
}
