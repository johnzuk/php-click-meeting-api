<?php
namespace ClickMeeting\Api\Conferences;

use ClickMeeting\Api\AbstractApi;

/**
 * Class Recordings
 * @package ClickMeeting\Api\Conferences
 */
class Recordings extends AbstractApi
{
    /**
     * @param int $roomId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function all($roomId)
    {
        return $this->get('conferences/'.$roomId.'/recordings');
    }

    /**
     * @param int $roomId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function deleteAll($roomId)
    {
        return $this->deleteRequest('conferences/'.$roomId.'/recordings');
    }

    /**
     * @param int $roomId
     * @param int $recordingId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function delete($roomId, $recordingId)
    {
        return $this->deleteRequest('conferences/'.$roomId.'/recordings/'.$recordingId);
    }
}