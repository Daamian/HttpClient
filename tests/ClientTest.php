<?php


namespace Daamian\HttpClient;

use Daamian\HttpClient\Exception\HttpExecuteException;
use Daamian\HttpClient\Http\HttpInterface;
use Daamian\HttpClient\Request\RequestChecker;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\RequestExceptionInterface;

class ClientTest extends TestCase
{

    private Client $client;

    private MockObject $httpMock;

    private MockObject $requestCheckerMock;

    public function setUp(): void
    {
        $this->httpMock = $this->createMock(HttpInterface::class);
        $this->requestCheckerMock = $this->createMock(RequestChecker::class);
        $this->client = new Client($this->httpMock, $this->requestCheckerMock);
    }

    public function testShouldReturnPsr7Response(): void
    {
        //Given
        $request = new Request(
            'POST',
            'http://api.com',
            ['Content-Type' => 'application/json'],
            'Body'
        );

        $response = 'Response';
        $this->httpMock->expects($this->once())
            ->method('execute')
            ->willReturn($response);

        $this->httpMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        //Expected
        $responseExpected = new Response(200, [], $response);

        //When
        $response = $this->client->sendRequest($request);

        //Then
        $this->assertEquals($responseExpected->getBody()->__toString(), $response->getBody()->__toString());
    }


    public function testShouldThrowClientExceptionWhenHttpExecuteThrowHttpExecuteException(): void
    {
        //Given
        $request = new Request('GET', 'http://api.com');

        $this->httpMock->expects($this->once())
            ->method('execute')
            ->willThrowException(new HttpExecuteException('message'));

        //Expected
        $this->expectException(ClientExceptionInterface::class);
        $this->expectErrorMessage('message');

        //When
        $this->client->sendRequest($request);
    }

    public function testShouldThrowClientExceptionWhenRequestCheckerReturnFalse(): void
    {
        //Given
        $request = new Request('', '');

        $this->requestCheckerMock->expects($this->once())
            ->method('check')
            ->with($request)
            ->willReturn(false);

        $this->requestCheckerMock->expects($this->once())
            ->method('getMessage')
            ->willReturn('testMessage');

        //Expected
        $this->expectException(RequestExceptionInterface::class);
        $this->expectErrorMessage('testMessage');

        //When
        $this->client->sendRequest($request);

    }


}
