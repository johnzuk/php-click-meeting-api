<?php
namespace ClickMeeting\Api;

/**
 * Class Ping
 * @package ClickMeeting\Api
 */
class Ping extends AbstractApi
{
    /**
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function ping()
    {
        return $this->get('ping');
    }
}
