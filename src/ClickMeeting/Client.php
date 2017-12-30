<?php
namespace ClickMeeting;

use ClickMeeting\Api\Chat;
use ClickMeeting\Api\Conferences;
use ClickMeeting\Api\Contacts;
use ClickMeeting\Api\Files;
use ClickMeeting\Api\PhoneGateways;
use ClickMeeting\Api\Ping;
use ClickMeeting\Api\TimeZones;
use ClickMeeting\HttpClient\Builder;
use ClickMeeting\HttpClient\Plugin\ApiVersion;
use ClickMeeting\HttpClient\Plugin\Authentication;
use ClickMeeting\HttpClient\Plugin\ClickMeetingExceptionThrower;
use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\HttpClient;
use Http\Discovery\UriFactoryDiscovery;

/**
 * Class Client
 * @package ClickMeeting
 */
class Client
{
    /**
     * @var Builder
     */
    protected $httpClientBuilder;

    /**
     * Client constructor.
     * @param Builder $httpClientBuilder
     */
    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $httpClientBuilder ?: new Builder();
        $this->addPlugin(new ClickMeetingExceptionThrower());
        $this->addPlugin(new ApiVersion());
        $this->addPlugin(new HeaderDefaultsPlugin([
            'Accept' => 'application/json',
            'User-Agent' => 'php-click-meeting-api (https://github.com/johnzuk/php-click-meeting-api)',
        ]));

        $this->setUrl('https://api.clickmeeting.com/');
    }

    /**
     * @param string $url
     * @return Client
     */
    public static function create($url)
    {
        $client = new self();
        $client->setUrl($url);

        return $client;
    }

    /**
     * @param HttpClient $httpClient
     * @return Client
     */
    public static function createWithHttpClient(HttpClient $httpClient)
    {
        $builder = new Builder($httpClient);
        return new self($builder);
    }

    /**
     * @return \Http\Client\Common\HttpMethodsClient
     */
    public function getHttpClient()
    {
        return $this->httpClientBuilder->getHttpClient();
    }

    /**
     * @param string $token
     */
    public function authenticate($token)
    {
        $this->httpClientBuilder->removePlugin(Authentication::class);
        $this->httpClientBuilder->addPlugin(new Authentication($token));
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->removePlugin(AddHostPlugin::class);
        $this->addPlugin(new AddHostPlugin(UriFactoryDiscovery::find()->createUri($url)));

        return $this;
    }

    /**
     * @return Conferences
     */
    public function conferences()
    {
        return new Conferences($this);
    }

    /**
     * @return Contacts
     */
    public function contacts()
    {
        return new Contacts($this);
    }

    /**
     * @return Conferences\Sessions
     */
    public function sessions()
    {
        return new Conferences\Sessions($this);
    }

    /**
     * @return Conferences\Tokens
     */
    public function tokens()
    {
        return new Conferences\Tokens($this);
    }

    /**
     * @return Conferences\Registrations
     */
    public function registrations()
    {
        return new Conferences\Registrations($this);
    }

    /**
     * @return TimeZones
     */
    public function timeZones()
    {
        return new TimeZones($this);
    }

    /**
     * @return PhoneGateways
     */
    public function phoneGateways()
    {
        return new PhoneGateways($this);
    }

    /**
     * @return Files
     */
    public function files()
    {
        return new Files($this);
    }

    /**
     * @return Conferences\Recordings
     */
    public function recordings()
    {
        return new Conferences\Recordings($this);
    }

    /**
     * @return Chat
     */
    public function chat()
    {
        return new Chat($this);
    }

    /**
     * @return Ping
     */
    public function ping()
    {
        return new Ping($this);
    }

    /**
     * @param Plugin $plugin
     */
    protected function addPlugin(Plugin $plugin)
    {
        $this->httpClientBuilder->addPlugin($plugin);
    }

    /**
     * @param string $className
     */
    protected function removePlugin($className)
    {
        $this->httpClientBuilder->removePlugin($className);
    }
}
