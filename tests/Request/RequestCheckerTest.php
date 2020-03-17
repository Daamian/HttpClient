<?php

namespace Daamian\HttpClient\Request;

use Nyholm\Psr7\Request;
use PHPUnit\Framework\TestCase;

class RequestCheckerTest extends TestCase
{

    private RequestChecker $requestChecker;

    public function setUp(): void
    {
        $this->requestChecker = new RequestChecker();
    }

    public function testShouldReturnFalseWhenRequestMethodIsEmpty(): void
    {
        //Given
        $request = new Request('', 'url');

        //When
        $result = $this->requestChecker->check($request);

        //Then
        $this->assertFalse($result);
    }


    public function testShouldSetEmptyMethodMessageWhenRequestMethodIsEmpty(): void
    {
        //Given
        $request = new Request('', 'url');

        //Expected
        $messageExpected = 'Request method cannot be empty';

        //When
        $this->requestChecker->check($request);

        //Then
        $this->assertSame($messageExpected, $this->requestChecker->getMessage());
    }


    public function testShouldReturnFalseWhenRequestUrlIsEmpty(): void
    {
        //Given
        $request = new Request('method', '');

        //When
        $result = $this->requestChecker->check($request);

        //Then
        $this->assertFalse($result);
    }

    public function testShouldSetEmptyUrlMessageWhenRequestMethodIsEmpty(): void
    {
        //Given
        $request = new Request('method', '');

        //Expected
        $messageExpected = 'Request url cannot be empty';

        //When
        $this->requestChecker->check($request);

        //Then
        $this->assertSame($messageExpected, $this->requestChecker->getMessage());
    }

}
