<?php

namespace Daamian\HttpClient\Http;

use Daamian\HttpClient\Authorization\JwtAuthorization;
use PHPUnit\Framework\TestCase;

class JwtAuthorizationTest extends TestCase
{
    private JwtAuthorization $jwtAuthorization;

    private string $token = 'tokeTest';

    public function setUp(): void
    {
        $this->jwtAuthorization = new JwtAuthorization($this->token);
    }

    public function testShouldAddJwtAuthorizationHeaderToHttp(): void
    {
        //Given
        $httpMock = $this->createMock(HttpInterface::class);

        //Expected
        $httpMock->expects($this->once())
            ->method('addHeader')
            ->with('Authorization', 'Bearer '.$this->token);

        //When
        $this->jwtAuthorization->auth($httpMock);

        //Then
        $this->assertTrue(true);
    }

}
