<?php

namespace ClickMeeting\Api;

use ClickMeeting\Client;
use ClickMeeting\HttpClient\Message\QueryBuilder;
use ClickMeeting\HttpClient\Message\ResponseMediator;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Http\Message\StreamFactory;
use Psr\Http\Message\ResponseInterface;
use SplFileObject;

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

    public function __construct(Client $client, StreamFactory $streamFactory = null)
    {
        $this->client = $client;
        $this->streamFactory = $streamFactory ?: Psr17FactoryDiscovery::findStreamFactory();
    }

    protected function getAsResponse(string $path): ResponseInterface
    {
        return $this->client->getHttpClient()->get($path);
    }

    protected function get(string $path): array
    {
        $response = $this->getAsResponse($path);

        return ResponseMediator::getContent($response);
    }

    protected function upload(string $path, SplFileObject $file, string $fileName): array
    {
        $builder = new MultipartStreamBuilder($this->streamFactory);
        $builder->addResource($fileName, $file->fread($file->getSize()), [
            'filename' => $file->getBasename(),
        ]);

        $requestHeaders['Content-Type'] = 'multipart/form-data; boundary=' . $builder->getBoundary();

        $response = $this->client->getHttpClient()->post(
            $path,
            $requestHeaders,
            $builder->build()
        );

        return ResponseMediator::getContent($response);
    }

    protected function post(string $path, array $parameters = [], array $requestHeaders = []): array
    {
        $body = $this->streamFactory->createStream(QueryBuilder::build($parameters));
        $requestHeaders['Content-Type'] = 'application/x-www-form-urlencoded';

        $response = $this->client->getHttpClient()->post(
            $path,
            $requestHeaders,
            $body
        );

        return ResponseMediator::getContent($response);
    }

    protected function put(string $path, array $parameters = [], array $requestHeaders = []): array
    {
        $body = $this->streamFactory->createStream(QueryBuilder::build($parameters));
        $requestHeaders['Content-Type'] = 'application/x-www-form-urlencoded';

        $response = $this->client->getHttpClient()->put(
            $path,
            $requestHeaders,
            $body
        );

        return ResponseMediator::getContent($response);
    }

    protected function deleteRequest(string $path): array
    {
        $response = $this->client->getHttpClient()->delete($path);

        return ResponseMediator::getContent($response);
    }
}
