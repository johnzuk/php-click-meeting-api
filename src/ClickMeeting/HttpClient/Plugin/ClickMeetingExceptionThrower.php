<?php
namespace ClickMeeting\HttpClient\Plugin;

use ClickMeeting\Exception\BarRequestException;
use ClickMeeting\Exception\InvalidResponseContentType;
use ClickMeeting\Exception\NotFoundException;
use ClickMeeting\Exception\TimeLimitExceededException;
use ClickMeeting\Exception\UnauthorizedException;
use ClickMeeting\HttpClient\Message\ResponseMediator;
use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ClickMeetingExceptionThrower
 * @package ClickMeeting\HttpClient\Plugin
 */
class ClickMeetingExceptionThrower implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        return $next($request)->then(function (ResponseInterface $response) {

            if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 600) {
                $content = $response->getBody()->__toString();

                if ($response->getStatusCode() === 400) {
                    if (stripos($content, 'limit') !== false) {
                        throw new TimeLimitExceededException($content, 400);
                    }

                    throw new BarRequestException($content, 400);
                }
                if ($response->getStatusCode() === 401) {
                    throw new UnauthorizedException($content, 401);
                }
                if ($response->getStatusCode() === 404) {
                    throw new NotFoundException($content, 404);
                }

                throw new \HttpException($content, $response->getStatusCode());
            }

            return $response;
        });
    }
}
