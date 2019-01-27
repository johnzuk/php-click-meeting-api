<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.12.17
 * Time: 17:44
 */

namespace ClickMeeting\Api\Conferences;

use ClickMeeting\Api\AbstractApi;

/**
 * Class Session
 * @package ClickMeeting\Api
 */
class Sessions extends AbstractApi
{
    /**
     * @param int $roomId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function all($roomId)
    {
        return $this->get('conferences/'.$roomId.'/sessions');
    }

    /**
     * @param int $roomId
     * @param int $sessionId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function session($roomId, $sessionId)
    {
        return $this->get('conferences/'.$roomId.'/sessions/'.$sessionId);
    }

    /**
     * @param int $roomId
     * @param int $sessionId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function attendees($roomId, $sessionId)
    {
        return $this->get('conferences/'.$roomId.'/sessions/'.$sessionId.'/attendees');
    }

    /**
     * @param int $roomId
     * @param int $sessionId
     * @param string $lang
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function generatePdf($roomId, $sessionId, $lang)
    {
        return $this->get('conferences/'.$roomId.'/sessions/'.$sessionId.'/generate-pdf/'.$lang);
    }
}