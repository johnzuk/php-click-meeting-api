<?php
namespace ClickMeeting\Api\Conferences;

use ClickMeeting\Api\AbstractApi;

/**
 * Class Tokens
 * @package ClickMeeting\Api
 */
class Tokens extends AbstractApi
{
    /**
     * @param int $roomId
     * @param int $howMany
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function generate($roomId, $howMany)
    {
        return $this->post('conferences/'.$roomId.'/tokens', [
            'how_many' => $howMany
        ]);
    }

    /**
     * @param $roomId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function all($roomId)
    {
        return $this->get('conferences/'.$roomId.'/tokens');
    }
}
