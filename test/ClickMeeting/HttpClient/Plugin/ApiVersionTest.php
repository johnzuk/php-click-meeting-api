<?php

namespace ClickMeeting\Tests\ClickMeeting\HttpClient\Plugin;

use ClickMeeting\HttpClient\Plugin\ApiVersion;
use Http\Client\Common\Plugin\AddPathPlugin;
use Http\Client\Promise\HttpFulfilledPromise;
use Http\Discovery\Psr17FactoryDiscovery;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class ApiVersionTest extends TestCase
{
    public function testHandleRequestWillAddApiVersionWhenApiRequestDone(): void
    {
        $request = new Request('GET', 'https://api.clickmeeting.com/ping', ['Content-Type' => 'application/json']);

        $verify = function (RequestInterface $request) {
            $this->assertEquals('https://api.clickmeeting.com/v1/ping', $request->getUri()->__toString());

            return new HttpFulfilledPromise(new Response(200));
        };

        $uri = Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.clickmeeting.com/v1');
        $plugin = new ApiVersion(new AddPathPlugin($uri));
        $plugin->handleRequest($request, $verify, static function() {});
    }

    public function testHandleRequestWillNodAddApiVersionWhenNonApiRequestDone(): void
    {
        $request = new Request('GET', 'https://test.place.com/ping', ['Content-Type' => 'application/json']);

        $verify = function (RequestInterface $request) {
            $this->assertEquals('https://test.place.com/ping', $request->getUri()->__toString());

            return new HttpFulfilledPromise(new Response(200));
        };

        $uri = Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.clickmeeting.com/v1');
        $plugin = new ApiVersion(new AddPathPlugin($uri));
        $plugin->handleRequest($request, $verify, static function() {});
    }
}
