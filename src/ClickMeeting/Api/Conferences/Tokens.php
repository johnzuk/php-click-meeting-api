<?php

namespace ClickMeeting\Api\Conferences;

use ClickMeeting\Api\AbstractApi;

class Tokens extends AbstractApi
{
    public function generate(int $roomId, int $howMany): array
    {
        return $this->post('/conferences/' . $roomId . '/tokens', [
            'how_many' => (string) $howMany
        ]);
    }

    public function all(int $roomId): array
    {
        return $this->get('/conferences/' . $roomId . '/tokens');
    }
}
