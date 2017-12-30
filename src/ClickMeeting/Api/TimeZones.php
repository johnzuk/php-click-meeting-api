<?php
namespace ClickMeeting\Api;

/**
 * Class TimeZone
 * @package ClickMeeting\Api
 */
class TimeZones extends AbstractApi
{
    /**
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function all()
    {
        return $this->get('time_zone_list');
    }

    /**
     * @param string $country
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function byCountry($country)
    {
        return $this->get('time_zone_list/'.$country);
    }
}
