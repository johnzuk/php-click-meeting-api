<?php

namespace ClickMeeting\HttpClient\Message;

use ClickMeeting\Exception\InvalidResponseContentType;
use Psr\Http\Message\ResponseInterface;

class ResponseMediator
{
    public static function getContent(ResponseInterface $response): array
    {
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $content = json_decode($response->getBody()->getContents(), true);

            if (JSON_ERROR_NONE === json_last_error()) {
                return $content;
            }
        }

        throw InvalidResponseContentType::fromResponse($response);
    }
}
