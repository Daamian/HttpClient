<?php


namespace Daamian\HttpClient\Exception;

use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Throwable;
use Exception;

class RequestException extends Exception implements RequestExceptionInterface
{
    private RequestInterface $request;

    public function __construct(RequestInterface $request, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->request = $request;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
