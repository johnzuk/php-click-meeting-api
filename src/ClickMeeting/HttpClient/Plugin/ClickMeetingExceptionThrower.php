<?php

namespace ClickMeeting\HttpClient\Plugin;

use ClickMeeting\Exception\BadRequestException;
use ClickMeeting\Exception\NotFoundException;
use ClickMeeting\Exception\RequestException;
use ClickMeeting\Exception\UnauthorizedException;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ClickMeetingExceptionThrower implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(static function (ResponseInterface $response): ResponseInterface {
            $statusCode = $response->getStatusCode();

            if ($statusCode >= 400 && $statusCode < 600) {
                $content = $response->getBody()->getContents();

                if ($statusCode === 400) {
                    throw new BadRequestException($content, $statusCode);
                }
                if ($statusCode === 401) {
                    throw new UnauthorizedException($content, $statusCode);
                }
                if ($statusCode === 404) {
                    throw new NotFoundException($content, $statusCode);
                }

                throw new RequestException($content, $response->getStatusCode());
            }

            return $response;
        });
    }
}
