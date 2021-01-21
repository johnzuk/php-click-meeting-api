<?php

namespace ClickMeeting\HttpClient\Message;

class QueryBuilder
{
    public static function build(array $parameters): string
    {
        return http_build_query($parameters);
    }
}
