<?php

namespace ClickMeeting\Tests\ClickMeeting\HttpClient\Message;

use ClickMeeting\HttpClient\Message\QueryBuilder;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{
    public function testBuildWillReturnCorrectQueryPath(): void
    {
        self::assertSame(
            'name=test&required=1&animation%5Burl%5D=test2&animation%5Bname%5D=test3',
            QueryBuilder::build([
                'name' => 'test',
                'required' => true,
                'animation' => [
                    'url' => 'test2',
                    'name' => 'test3',
                ],
        ]));
    }
}
