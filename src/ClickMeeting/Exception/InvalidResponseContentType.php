<?php

namespace ClickMeeting\Exception;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

class InvalidResponseContentType extends InvalidArgumentException
{
    public static function fromResponse(ResponseInterface $response): self
    {
        return new self(sprintf('Invalid response content type: "%s"', $response->getHeaderLine('Content-Type')));
    }
}
