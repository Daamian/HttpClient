<?php

namespace Daamian\HttpClient\Exception;

use Psr\Http\Client\ClientExceptionInterface;
use Exception;

class ClientException extends Exception implements ClientExceptionInterface
{

}
