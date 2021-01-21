<?php

namespace ClickMeeting\Tests\ClickMeeting\HttpClient\Message;

use ClickMeeting\Exception\InvalidResponseContentType;
use ClickMeeting\HttpClient\Message\ResponseMediator;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ResponseMediatorTest extends TestCase
{
    public function testGetContentWillThrowInvalidResponseContentExceptionTypeWhenInvalidContentTypeProvided(): void
    {
        $this->expectException(InvalidResponseContentType::class);
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response->method('getHeaderLine')->willReturn('text/html');

        ResponseMediator::getContent($response);
    }

    public function testGetContentWillThrowInvalidResponseContentExceptionWhenInvalidJsonContentProvided(): void
    {
        $this->expectException(InvalidResponseContentType::class);
        $response = $this->createMock(ResponseInterface::class);
        $content = $this->createMock(StreamInterface::class);
        $content->method('getContents')->willReturn('test');

        $response->method('getHeaderLine')->willReturn('application/json');
        $response->method('getBody')->willReturn($content);

        ResponseMediator::getContent($response);
    }

    public function testGetContentWillReturnDecodedJsonRepresentationWhenCorrectResponseProvided(): void
    {
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $content = $this->createMock(StreamInterface::class);
        $content->method('getContents')->willReturn('{"test": "name"}');

        $response->method('getHeaderLine')->willReturn('application/json');
        $response->method('getBody')->willReturn($content);

        self::assertSame(['test' => 'name'], ResponseMediator::getContent($response));
    }
}
