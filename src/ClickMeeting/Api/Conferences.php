<?php
namespace ClickMeeting\Api;
use ClickMeeting\Api\Conferences\Registrations;
use ClickMeeting\Api\Conferences\Sessions;
use ClickMeeting\Api\Conferences\Tokens;

/**
 * Class Conferences
 * @package ClickMeeting\Api
 */
class Conferences extends AbstractApi
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    const CONFERENCE_STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE
    ];

    /**
     * @param string $status
     * @param int|null $page
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function all($status = 'active', $page = null)
    {
        if (!in_array($status, self::CONFERENCE_STATUSES)) {
            throw new \InvalidArgumentException(sprintf("Invalid status '%s'", $status));
        }
        $parameters = [];
        if (is_int($page)) {
            $parameters['page'] = $page;
        }

        return $this->get('conferences/'.$status, $parameters);
    }

    /**
     * @param array $parameters
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function add(array $parameters)
    {
        return $this->post('conferences', $parameters);
    }

    /**
     * @param int $roomId
     * @param array $parameters
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function edit($roomId, array $parameters)
    {
        return $this->put('conferences/'.$roomId, $parameters);
    }

    /**
     * @param int $roomId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function delete($roomId)
    {
        return $this->deleteRequest('conferences/'.$roomId);
    }

    /**
     * @param int $roomId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function room($roomId)
    {
        return $this->get('conferences/'.$roomId);
    }

    /**
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function skins()
    {
        return $this->get('conferences/skins');
    }

    /**
     * @param int $roomId
     * @param array $parameters
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function getAutoLoginUrlToMeetingRoom($roomId, array $parameters)
    {
        return $this->post('conferences/'.$roomId.'/room/autologin_hash', $parameters);
    }

    /**
     * @param int $roomId
     * @param string $lang
     * @param array $parameters
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function sendInvitationEmail($roomId, $lang, array $parameters)
    {
        return $this->post('conferences/'.$roomId.'/invitation/email/'.$lang, $parameters);
    }

    /**
     * @return Sessions
     */
    public function sessions()
    {
        return new Sessions($this->client);
    }

    /**
     * @return Tokens
     */
    public function tokens()
    {
        return new Tokens($this->client);
    }

    /**
     * @return Registrations
     */
    public function registrations()
    {
        return new Registrations($this->client);
    }
}
