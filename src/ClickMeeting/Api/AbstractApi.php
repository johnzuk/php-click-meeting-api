<?php
namespace ClickMeeting\Api;

use ClickMeeting\Client;
use ClickMeeting\HttpClient\Message\BodyBuilder;
use ClickMeeting\HttpClient\Message\PathBuilder;
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
     * @var BodyBuilder
     */
    protected $bodyBuilder;

    /**
     * AbstractApi constructor.
     * @param Client $client
     * @param StreamFactory|null $streamFactory
     * @param BodyBuilder|null $bodyBuilder
     */
    public function __construct(Client $client, StreamFactory $streamFactory = null, BodyBuilder $bodyBuilder = null)
    {
        $this->client = $client;
        $this->streamFactory = $streamFactory ?: StreamFactoryDiscovery::find();
        $this->bodyBuilder = $bodyBuilder ?: new BodyBuilder($this->streamFactory);
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $requestHeaders
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    protected function get($path, array $parameters = [], array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->get(PathBuilder::build($path, $parameters), $requestHeaders);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param $path
     * @param array $parameters
     * @param array $requestHeaders
     * @param array $files
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    protected function post($path, array $parameters = [], array $requestHeaders = [], array $files = [])
    {
        $postRequest = $this->bodyBuilder->build($parameters, $requestHeaders, $files);

        $response = $this->client->getHttpClient()->post(
            $path,
            $postRequest->getRequestHeaders(),
            $postRequest->getBody()
        );

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
    protected function put($path, array $parameters = [], array $requestHeaders = [])
    {
        $body = $this->streamFactory->createStream(QueryBuilder::build($parameters));
        $requestHeaders['Content-Type'] = 'application/x-www-form-urlencoded';

        $response = $this->client->getHttpClient()->put($path, $requestHeaders, $body);

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
    protected function deleteRequest($path, array $parameters = [], array $requestHeaders = [])
    {
        $response = $this->client->getHttpClient()->delete(PathBuilder::build($path, $parameters), $requestHeaders);

        return ResponseMediator::getContent($response);
    }
}
