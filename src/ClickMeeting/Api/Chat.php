<?php
namespace ClickMeeting\Api;

/**
 * Class Chat
 * @package ClickMeeting\Api
 */
class Chat extends AbstractApi
{
    /**
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function all()
    {
        return $this->get('chats');
    }

    /**
     * @param $sessionId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function details($sessionId)
    {
        return $this->get('chats/'.$sessionId);
    }
}
