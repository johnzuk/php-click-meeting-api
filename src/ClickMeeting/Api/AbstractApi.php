<?php
namespace ClickMeeting\Api;

use ClickMeeting\Client;
use ClickMeeting\HttpClient\Message\QueryBuilder;
use ClickMeeting\HttpClient\Message\ResponseMediator;
use Http\Discovery\StreamFactoryDiscovery;
use Http\Message\StreamFactory;

/**
 * Class AbstractApi
 * @package ClickMeeting\Api
 */
class AbstractApi implements ApiInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var StreamFactory
     */
    protected $streamFactory;

    /**
     * AbstractApi constructor.
     * @param Client $client
     * @param StreamFactory|null $streamFactory
     */
    public function __construct(Client $client, StreamFactory $streamFactory = null)
    {
        $this->client = $client;
        $this->streamFactory = $streamFactory ?: StreamFactoryDiscovery::find();
    }

    /**
     * @param string $path
     * @param array $requestHeaders
     * @return array
     *
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    protected function get($path, $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->get($path, $requestHeaders);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $requestHeaders
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    protected function post($path, $parameters = [], $requestHeaders = [])
    {
        $body = $this->streamFactory->createStream(QueryBuilder::build($parameters));
        $requestHeaders['Content-Type'] = 'application/x-www-form-urlencoded';

        $response = $this->client->getHttpClient()->post($path, $requestHeaders, $body);

        return ResponseMediator::getContent($response);
    }


    /**
     * @param $path
     * @param array $parameters
     * @param array $requestHeaders
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    protected function put($path, $parameters = [], $requestHeaders = [])
    {
        $body = $this->streamFactory->createStream(QueryBuilder::build($parameters));
        $requestHeaders['Content-Type'] = 'application/x-www-form-urlencoded';

        $response = $this->client->getHttpClient()->put($path, $requestHeaders, $body);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param $path
     * @param array $requestHeaders
     * @return array
     *
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    protected function deleteRequest($path, $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->delete($path, $requestHeaders);

        return ResponseMediator::getContent($response);
    }
}
