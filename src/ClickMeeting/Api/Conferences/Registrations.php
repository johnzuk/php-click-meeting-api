<?php
namespace ClickMeeting\Api\Conferences;

use ClickMeeting\Api\AbstractApi;

/**
 * Class Registrations
 * @package ClickMeeting\Api\Conferences
 */
class Registrations extends AbstractApi
{
    const STATUS_ACTIVE = 'active';
    const STATUS_ALL = 'all';

    const REGISTRATION_STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_ALL
    ];

    /**
     * @param int $roomId
     * @param string $status
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function all($roomId, $status='all')
    {
        if (!in_array($status, self::REGISTRATION_STATUSES)) {
            throw new \InvalidArgumentException(sprintf("Invalid status '%s'", $status));
        }

        return $this->get('conferences/'.$roomId.'/registrations/'.$status);
    }

    /**
     * @param int $roomId
     * @param array $parameters
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function registerParticipant($roomId, array $parameters)
    {
        return $this->post('conferences/'.$roomId.'/registration', $parameters);
    }

    /**
     * @param $roomId
     * @param $sessionId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function registeredParticipantInSession($roomId, $sessionId)
    {
        return $this->get('conferences/'.$roomId.'/sessions/'.$sessionId.'/registrations');
    }

    /**
     * @param int $roomId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function turnOnRegistration($roomId)
    {
        return $this->put('conferences/'.$roomId, [
            'registration' => [
                'enabled' => true,
            ],
        ]);
    }

    /**
     * @param int $roomId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function turnOffRegistration($roomId)
    {
        return $this->put('conferences/'.$roomId, [
            'registration' => [
                'enabled' => false,
            ],
        ]);
    }

    /**
     * @param int $roomId
     * @param bool $enabled
     * @param int $template
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function updateTemplate($roomId, $enabled, $template)
    {
        return $this->put('conferences/'.$roomId, [
            'registration' => [
                'enabled' => $enabled,
                'template' => $template,
            ],
        ]);
    }
}
