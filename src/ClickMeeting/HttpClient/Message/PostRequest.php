<?php
namespace ClickMeeting\HttpClient\Message;

use Psr\Http\Message\StreamInterface;

/**
 * Class PostBody
 * @package ClickMeeting\HttpClient\Message
 */
class PostRequest
{
    /**
     * @var string|StreamInterface|null $body
     */
    protected $body;

    /**
     * @var array
     */
    protected $requestHeaders = [];

    /**
     * PostBody constructor.
     * @param null|StreamInterface|string $body
     * @param array $requestHeaders
     */
    public function __construct($body, array $requestHeaders)
    {
        $this->body = $body;
        $this->requestHeaders = $requestHeaders;
    }

    /**
     * @return null|StreamInterface|string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param null|StreamInterface|string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return array
     */
    public function getRequestHeaders()
    {
        return $this->requestHeaders;
    }

    /**
     * @param array $requestHeaders
     */
    public function setRequestHeaders(array $requestHeaders)
    {
        $this->requestHeaders = $requestHeaders;
    }
}
