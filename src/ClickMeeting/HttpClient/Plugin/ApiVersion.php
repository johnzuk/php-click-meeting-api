<?php
namespace ClickMeeting\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;

/**
 * Class ApiVersion
 * @package ClickMeeting\HttpClient\Plugin
 */
class ApiVersion implements Plugin
{
    const API_VERSION = '/v1/';

    /**
     * @inheritdoc
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        $uri = $request->getUri();
        if (substr($uri->getPath(), 0, strlen(self::API_VERSION)) !== self::API_VERSION) {
            $request = $request->withUri($uri->withPath(self::API_VERSION.$uri->getPath()));
        }
        return $next($request);
    }
}
