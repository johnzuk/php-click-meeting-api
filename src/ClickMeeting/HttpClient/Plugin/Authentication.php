<?php
namespace ClickMeeting\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;

/**
 * Class Authentication
 * @package ClickMeeting\HttpClient\Plugin
 */
class Authentication implements Plugin
{
    /**
     * @var string
     */
    protected $token;

    /**
     * Authentication constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @inheritdoc
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        $request = $request->withHeader('X-Api-Key', $this->token);

        return $next($request);
    }
}
