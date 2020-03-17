<?php

namespace Daamian\HttpClient\Http\Curl;

use PHPUnit\Framework\TestCase;

class CurlFactoryTest extends TestCase
{

    public function testShouldCreateCurlInstance(): void
    {
        //Expected
        $curlInstanceExpected = Curl::class;

        //When
        $curl = CurlFactory::create();

        //Then
        $this->assertInstanceOf($curlInstanceExpected, $curl);
    }

}
