<?php

namespace Daamian\HttpClient\Http\Curl;

use PHPUnit\Framework\TestCase;

class CurlResultTest extends TestCase
{

    private CurlResult $curlResult;

    public function setUp(): void
    {
        $this->curlResult = new CurlResult(200, 'body', ['HEADER' => 'HEADER_CONTENT']);
    }

    public function testShouldMethodGetStatusCodeReturnCorrectValue(): void
    {
        $this->assertSame(200, $this->curlResult->getStatusCode());
    }

    public function testShouldMethodGetBodyReturnCorrectValue(): void
    {
        $this->assertSame('body', $this->curlResult->getBody());
    }

    public function testShouldMethodGetHeadersReturnCorrectValue(): void
    {
        $this->assertSame(['HEADER' => 'HEADER_CONTENT'], $this->curlResult->getHeaders());
    }

}
