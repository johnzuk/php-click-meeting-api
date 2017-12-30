<?php
namespace ClickMeeting\HttpClient\Message;

use ClickMeeting\Exception\InvalidResponseContentType;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseMediator
 * @package ClickMeeting\HttpClient\Message
 */
class ResponseMediator
{
    /**
     * @param ResponseInterface $response
     * @return array
     * @throws InvalidResponseContentType
     */
    public static function getContent(ResponseInterface $response)
    {
        $body = $response->getBody()->__toString();

        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $content = json_decode($body, true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new InvalidResponseContentType($body);
            }
        }

        return $content;
    }
}
