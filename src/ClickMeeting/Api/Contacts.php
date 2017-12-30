<?php
namespace ClickMeeting\Api;

/**
 * Class Contacts
 * @package ClickMeeting\Api
 */
class Contacts extends AbstractApi
{
    /**
     * @param array $parameters
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function add(array $parameters)
    {
        return $this->post('contacts', $parameters);
    }
}
