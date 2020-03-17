<?php

namespace Daamian\HttpClient\Http;

use Daamian\HttpClient\Authorization\BasicAuthorization;
use PHPUnit\Framework\TestCase;

class BasicAuthorizationTest extends TestCase
{

    private BasicAuthorization $basicAuthorization;

    private string $username = 'userTest';

    private string $password = 'passwordTest';

    public function setUp(): void
    {
        $this->basicAuthorization = new BasicAuthorization($this->username, $this->password);
    }

    public function testShouldAddBasicAuthorizationHeaderToHttp(): void
    {
        //Given
        $httpMock = $this->createMock(HttpInterface::class);

        //Expected
        $httpMock->expects($this->once())
            ->method('addHeader')
            ->with('Authorization', 'Basic '.base64_encode("$this->username:$this->password"));

        //When
        $this->basicAuthorization->auth($httpMock);

        //Then
        $this->assertTrue(true);
    }

}
