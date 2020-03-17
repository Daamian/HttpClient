<?php

namespace Daamian\HttpClient\Request;

use PHPUnit\Framework\TestCase;

class RequestCheckerFactoryTest extends TestCase
{

    public function testShouldCreateRequestCheckerInstance(): void
    {
        //Expected
        $requestCheckerInstanceExpected = RequestChecker::class;

        //When
        $client = RequestCheckerFactory::create();

        //Then
        $this->assertInstanceOf($requestCheckerInstanceExpected, $client);
    }

}
