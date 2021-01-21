<?php

namespace ClickMeeting\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AddPathPlugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

class ApiVersion implements Plugin
{
    private const BASE_API_HOST = 'api.clickmeeting.com';

    /** @var AddPathPlugin */
    private $pathPlugin;

    public function __construct(AddPathPlugin $pathPlugin)
    {
        $this->pathPlugin = $pathPlugin;
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        if ($request->getUri()->getHost() === self::BASE_API_HOST) {
            return $this->pathPlugin->handleRequest($request, $next, $first);
        }

        return $next($request);
    }
}
