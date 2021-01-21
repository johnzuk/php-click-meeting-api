<?php

namespace ClickMeeting\Tests\ClickMeeting\HttpClient\Message;

use ClickMeeting\HttpClient\Message\PathBuilder;
use PHPUnit\Framework\TestCase;

class PathBuilderTest extends TestCase
{
    public function testBuildWithNoParamsWillReturnCorrectPath(): void
    {
        self::assertSame('test', PathBuilder::build('test'));
    }

    public function testBuildWithParamWillReturnCorrectPath(): void
    {
        self::assertSame('test?page=10&limit=3', PathBuilder::build('test', ['page' => 10, 'limit' => 3]));
    }
}
