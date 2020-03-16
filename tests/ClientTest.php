<?php


namespace Daamian\HttpClient;

use Daamian\HttpClient\Http\HttpInterface;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Daamian\HttpClient\Client;

class ClientTest extends TestCase
{

    private Client $client;

    private MockObject $httpMock;

    public function setUp(): void
    {
        $this->httpMock = $this->createMock(HttpInterface::class);
        $this->client = new Client($this->httpMock);
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

        $this->httpMock->expects($this->once())
            ->method('execute')
            ->willReturn('Response');

        $this->httpMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        //Expected
        $responseExpected = new Response(200, [], 'Response');

        //When
        $response = $this->client->sendRequest($request);

        //Then
        $this->assertEquals($responseExpected, $response);

    }


}
