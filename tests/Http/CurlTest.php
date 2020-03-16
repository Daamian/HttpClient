<?php

namespace Daamian\HttpClient\Http;

use Daamian\HttpClient\Exception\HttpExecuteException;
use PHPUnit\Framework\TestCase;
use phpmock\phpunit\PHPMock;

class CurlTest extends TestCase
{

    use PHPMock;

    private Curl $curl;

    private string $handle = 'handleTest';

    public function setUp(): void
    {
        $curlInitMock = $this->getFunctionMock(__NAMESPACE__, "curl_init");
        $curlInitMock->expects($this->once())->with()->willReturn($this->handle);
        $this->curl = new Curl();
    }


    public function testShouldSetCurlOptUrl(): void
    {
        //Given
        $url = 'testUrl';

        //Expected
        $curlInitMock = $this->getFunctionMock(__NAMESPACE__, "curl_setopt");
        $curlInitMock->expects($this->once())->with($this->handle, CURLOPT_URL, $url)->willReturn(null);

        //When
        $curlInstance = $this->curl->setUrl($url);

        //Then
        $this->assertSame($this->curl, $curlInstance);
    }

    public function testShouldSetCurlOptMethod(): void
    {
        //Given
        $method = 'GET';

        //Expected
        $curlInitMock = $this->getFunctionMock(__NAMESPACE__, "curl_setopt");
        $curlInitMock->expects($this->once())->with($this->handle, CURLOPT_CUSTOMREQUEST, $method)->willReturn(null);

        //When
        $curlInstance = $this->curl->setMethod($method);

        //Then
        $this->assertSame($this->curl, $curlInstance);
    }

    public function testShouldSetCurlOptBody(): void
    {
        //Given
        $body = 'body';

        //Expected
        $curlInitMock = $this->getFunctionMock(__NAMESPACE__, "curl_setopt");
        $curlInitMock->expects($this->once())->with($this->handle, CURLOPT_POSTFIELDS, $body)->willReturn(null);

        //When
        $curlInstance = $this->curl->setBody($body);

        //Then
        $this->assertSame($this->curl, $curlInstance);
    }

    public function testShouldSetCurlOptHeaders(): void
    {
        //Given
        $headers = ['HEADER' => 'HEADER_VALUE'];

        //Expected
        $curlInitMock = $this->getFunctionMock(__NAMESPACE__, "curl_setopt");
        $curlInitMock->expects($this->once())->with($this->handle, CURLOPT_HTTPHEADER, $headers)->willReturn(null);

        //When
        $curlInstance = $this->curl->setHeaders($headers);

        //Then
        $this->assertSame($this->curl, $curlInstance);
    }

    public function testShouldCurlExecute(): void
    {
        //Given
        $curlSetOptMock = $this->getFunctionMock(__NAMESPACE__, "curl_setopt");
        $curlSetOptMock->expects($this->any())->willReturn(null);

        $curlCloseMock = $this->getFunctionMock(__NAMESPACE__, "curl_close");
        $curlCloseMock->expects($this->any())->willReturn(null);

        $curlGetInfoMock = $this->getFunctionMock(__NAMESPACE__, "curl_getinfo");
        $curlGetInfoMock->expects($this->any())->willReturn(null);

        //Expected
        $responseExpected = 'response';
        $curlExecMock = $this->getFunctionMock(__NAMESPACE__, "curl_exec");
        $curlExecMock->expects($this->once())->willReturn($responseExpected);

        //When
        $response = $this->curl->execute();

        //Then
        $this->assertSame($responseExpected, $response);
    }

    public function testShouldThrowHttpExecuteExceptionWhenCurlExecuteIsFailed(): void
    {
        //Given
        $curlSetOptMock = $this->getFunctionMock(__NAMESPACE__, "curl_setopt");
        $curlSetOptMock->expects($this->any())->willReturn(null);

        $curlCloseMock = $this->getFunctionMock(__NAMESPACE__, "curl_close");
        $curlCloseMock->expects($this->any())->willReturn(null);

        $curlGetInfoMock = $this->getFunctionMock(__NAMESPACE__, "curl_getinfo");
        $curlGetInfoMock->expects($this->any())->willReturn(null);

        //Expected
        $curlExecMock = $this->getFunctionMock(__NAMESPACE__, "curl_exec");
        $curlExecMock->expects($this->once())->willReturn(false);
        $this->expectException(HttpExecuteException::class);

        //When
        $this->curl->execute();
    }

    public function testShouldCurlStatusCode(): void
    {
        //Given
        $curlSetOptMock = $this->getFunctionMock(__NAMESPACE__, "curl_setopt");
        $curlSetOptMock->expects($this->any())->willReturn(null);

        $curlCloseMock = $this->getFunctionMock(__NAMESPACE__, "curl_close");
        $curlCloseMock->expects($this->any())->willReturn(null);

        $curlExecMock = $this->getFunctionMock(__NAMESPACE__, "curl_exec");
        $curlExecMock->expects($this->once())->willReturn('test');

        //Expected
        $statusCodeExpected = 200;
        $curlGetInfoMock = $this->getFunctionMock(__NAMESPACE__, "curl_getinfo");
        $curlGetInfoMock->expects($this->once())->willReturn($statusCodeExpected);


        //When
        $this->curl->execute();

        //Then
        $this->assertSame($statusCodeExpected, $this->curl->getStatusCode());
    }


}
