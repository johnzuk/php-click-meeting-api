<?php

namespace ClickMeeting;

use ClickMeeting\Api\Chats;
use ClickMeeting\Api\Conferences;
use ClickMeeting\Api\Contacts;
use ClickMeeting\Api\FileLibrary;
use ClickMeeting\Api\PhoneGateways;
use ClickMeeting\Api\Ping;
use ClickMeeting\Api\TimeZones;
use ClickMeeting\HttpClient\Builder;
use ClickMeeting\HttpClient\Plugin\ApiVersion;
use ClickMeeting\HttpClient\Plugin\ClickMeetingExceptionThrower;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\AddPathPlugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\Authentication\Header;

class Client
{
    private const API_URL = 'https://api.clickmeeting.com/v1';
    private const AUTHENTICATION_HEADER = 'X-Api-Key';

    /**
     * @var Builder
     */
    protected $httpClientBuilder;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $httpClientBuilder ?: new Builder();
        $uri = Psr17FactoryDiscovery::findUriFactory()->createUri(self::API_URL);

        $this->httpClientBuilder->addPlugin(new RedirectPlugin());
        $this->httpClientBuilder->addPlugin(new AddHostPlugin($uri));
        $this->httpClientBuilder->addPlugin(new ApiVersion(new AddPathPlugin($uri)));
        $this->httpClientBuilder->addPlugin(new HeaderDefaultsPlugin([
            'Accept' => 'application/json',
            'User-Agent' => 'php-click-meeting-api (https://github.com/johnzuk/php-click-meeting-api)',
        ]));
        $this->httpClientBuilder->addPlugin(new ClickMeetingExceptionThrower());
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->httpClientBuilder->getHttpClient();
    }

    public function authenticate(string $token): void
    {
        $this->httpClientBuilder->removePlugin(AuthenticationPlugin::class);
        $this->httpClientBuilder->addPlugin(new AuthenticationPlugin(new Header(self::AUTHENTICATION_HEADER, $token)));
    }

    public function conferences(): Conferences
    {
        return new Conferences($this);
    }

    public function contacts(): Contacts
    {
        return new Contacts($this);
    }

    public function timeZones(): TimeZones
    {
        return new TimeZones($this);
    }

    public function phoneGateways(): PhoneGateways
    {
        return new PhoneGateways($this);
    }

    public function fileLibrary(): FileLibrary
    {
        return new FileLibrary($this);
    }

    public function chats(): Chats
    {
        return new Chats($this);
    }

    public function ping(): Ping
    {
        return new Ping($this);
    }
}
