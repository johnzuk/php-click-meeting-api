<?php
namespace ClickMeeting\Api;

/**
 * Class PhoneGateways
 * @package ClickMeeting\Api
 */
class PhoneGateways extends AbstractApi
{
    /**
     * @return string
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function all()
    {
        return $this->get('phone_gateways');
    }
}
