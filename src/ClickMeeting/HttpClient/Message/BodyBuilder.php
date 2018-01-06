<?php
namespace ClickMeeting\HttpClient\Message;

use Http\Discovery\StreamFactoryDiscovery;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Http\Message\StreamFactory;

/**
 * Class BodyBuilder
 * @package ClickMeeting\HttpClient\Message
 */
class BodyBuilder
{
    /**
     * @var StreamFactory
     */
    protected $streamFactory;

    /**
     * BodyBuilder constructor.
     * @param StreamFactory $streamFactory
     */
    public function __construct(StreamFactory $streamFactory = null)
    {
        $this->streamFactory = $streamFactory ?: StreamFactoryDiscovery::find();
    }

    /**
     * @param array $parameters
     * @param array $requestHeaders
     * @param array $files
     * @return PostRequest
     */
    public function build(array $parameters = [], array $requestHeaders = [], array $files = [])
    {
        $body = null;

        if (empty($files) && !empty($parameters)) {
            $body = $this->streamFactory->createStream(QueryBuilder::build($parameters));
            $requestHeaders['Content-Type'] = 'application/x-www-form-urlencoded';

            return new PostRequest($body, $requestHeaders);
        } else if (!empty($files)) {

            $builder = new MultipartStreamBuilder($this->streamFactory);
            foreach ($parameters as $name => $value) {
                $builder->addResource($name, $value);
            }
            foreach ($files as $name => $file) {
                $builder->addResource($name, fopen($file, 'r'), [
                    'headers' => [
                        'Content-Type' => $this->guessContentType($file),
                    ],
                    'filename' => basename($file),
                ]);
            }
            $body = $builder->build();
            $requestHeaders['Content-Type'] = 'multipart/form-data; boundary='.$builder->getBoundary();

            return new PostRequest($body, $requestHeaders);
        }

        return new PostRequest($body, $requestHeaders);
    }

    /**
     * @param $file
     *
     * @return string
     */
    private function guessContentType($file)
    {
        if (!class_exists(\finfo::class, false)) {
            return 'application/octet-stream';
        }
        $finfo = new \finfo(FILEINFO_MIME_TYPE);

        return $finfo->file($file);
    }
}
