<?php

namespace Daamian\HttpClient\Request;

use Psr\Http\Message\RequestInterface;

class RequestChecker
{
    private ?string $message;

    const EMPTY_METHOD_MESSAGE = 'Request method cannot be empty';

    const EMPTY_URI_MESSAGE = 'Request url cannot be empty';

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function check(RequestInterface $request): bool
    {
        if (true === empty($request->getMethod())) {
            $this->message = self::EMPTY_METHOD_MESSAGE;

            return false;
        }

        if (true === empty($request->getUri()->getHost())) {
            $this->message = self::EMPTY_URI_MESSAGE;

            return false;
        }

        return true;
    }

}
