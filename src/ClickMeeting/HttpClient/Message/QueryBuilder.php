<?php
namespace ClickMeeting\HttpClient\Message;

/**
 * Class QueryBuilder
 * @package ClickMeeting\HttpClient\Message
 */
class QueryBuilder
{
    /**
     * @param array $parameters
     * @return string
     */
    public static function build(array $parameters)
    {
        return http_build_query($parameters, '', '&');
    }
}
