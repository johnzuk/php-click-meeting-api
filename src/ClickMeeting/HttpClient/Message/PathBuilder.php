<?php
namespace ClickMeeting\HttpClient\Message;

/**
 * Class PathBuilder
 * @package ClickMeeting\HttpClient\Message
 */
class PathBuilder
{
    /**
     * @param string $path
     * @param array $parameters
     * @return string
     */
    public static function build($path, array $parameters = [])
    {
        if (count($parameters) > 0) {
            $path .= '?'.QueryBuilder::build($parameters);
        }

        return $path;
    }
}
