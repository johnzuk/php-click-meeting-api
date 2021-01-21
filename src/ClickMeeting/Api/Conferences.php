<?php

namespace ClickMeeting\Api;

use ClickMeeting\Api\Conferences\Recordings;
use ClickMeeting\Api\Conferences\Registrations;
use ClickMeeting\Api\Conferences\Sessions;
use ClickMeeting\Api\Conferences\Tokens;
use ClickMeeting\HttpClient\Message\PathBuilder;

class Conferences extends AbstractApi
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    private const CONFERENCE_STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE
    ];

    public function all(string $status = self::STATUS_INACTIVE, int $page = null): array
    {
        if (!in_array($status, self::CONFERENCE_STATUSES, true)) {
            throw new \InvalidArgumentException(sprintf("Invalid status '%s'", $status));
        }

        $parameters = [];
        if ($page) {
            $parameters['page'] = $page;
        }

        $path = PathBuilder::build('/conferences/' . $status, $parameters);
        return $this->get($path);
    }

    public function add(array $parameters): array
    {
        return $this->post('/conferences', $parameters);
    }

    public function edit(int $roomId, array $parameters): array
    {
        return $this->put('/conferences/' . $roomId, $parameters);
    }

    public function delete(int $roomId): array
    {
        return $this->deleteRequest('/conferences/' . $roomId);
    }

    public function room(int $roomId): array
    {
        return $this->get('/conferences/' . $roomId);
    }

    public function skins(): array
    {
        return $this->get('/conferences/skins');
    }

    public function autoLoginHash(int $roomId, array $parameters): array
    {
        return $this->post('/conferences/' . $roomId . '/room/autologin_hash', $parameters);
    }

    public function invitation(int $roomId, string $lang, array $parameters): array
    {
        return $this->post('/conferences/' . $roomId . '/invitation/email/' . $lang, $parameters);
    }

    public function sessions(): Sessions
    {
        return new Sessions($this->client);
    }

    public function tokens(): Tokens
    {
        return new Tokens($this->client);
    }

    public function registrations(): Registrations
    {
        return new Registrations($this->client);
    }

    public function recordings(): Recordings
    {
        return new Recordings($this->client);
    }
}
