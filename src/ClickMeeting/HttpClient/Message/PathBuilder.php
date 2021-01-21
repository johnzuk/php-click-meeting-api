<?php

namespace ClickMeeting\HttpClient\Message;

class PathBuilder
{
    public static function build(string $path, array $parameters = []): string
    {
        if (count($parameters) > 0) {
            $path .= '?' . QueryBuilder::build($parameters);
        }

        return $path;
    }
}
