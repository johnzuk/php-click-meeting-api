<?php

namespace ClickMeeting\Api\Conferences;

use ClickMeeting\Api\AbstractApi;
use InvalidArgumentException;

class Registrations extends AbstractApi
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_ALL = 'all';

    public const REGISTRATION_STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_ALL
    ];

    public function all(int $roomId, string $status = self::STATUS_ALL): array
    {
        if (!in_array($status, self::REGISTRATION_STATUSES)) {
            throw new InvalidArgumentException(sprintf("Invalid status '%s'", $status));
        }

        return $this->get('/conferences/' . $roomId . '/registrations/' . $status);
    }

    public function register(int $roomId, array $parameters): array
    {
        return $this->post('/conferences/' . $roomId . '/registration', $parameters);
    }

    public function participants(int $roomId, int $sessionId): array
    {
        return $this->get('/conferences/' . $roomId . '/sessions/' . $sessionId . '/registrations');
    }

    public function enableRegistration(int $roomId): array
    {
        return $this->put('/conferences/' . $roomId, [
            'registration' => [
                'enabled' => true,
            ],
        ]);
    }

    public function disableRegistration(int $roomId): array
    {
        return $this->put('/conferences/' . $roomId, [
            'registration' => [
                'enabled' => false,
            ],
        ]);
    }

    public function template(int $roomId, bool $enabled, int $template): array
    {
        return $this->put('/conferences/' . $roomId, [
            'registration' => [
                'enabled' => $enabled,
                'template' => $template,
            ],
        ]);
    }
}
