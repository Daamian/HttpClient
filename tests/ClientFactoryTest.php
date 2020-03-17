<?php

namespace Daamian\HttpClient;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

class ClientFactoryTest extends TestCase
{

    public function testShouldCreateClientInstance(): void
    {
        //Expected
        $clientInstanceExpected = ClientInterface::class;

        //When
        $client = ClientFactory::create();

        //Then
        $this->assertInstanceOf($clientInstanceExpected, $client);
    }

}
