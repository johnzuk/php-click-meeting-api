<?php

namespace ClickMeeting\Api\Conferences;

use ClickMeeting\Api\AbstractApi;

class Sessions extends AbstractApi
{
    public function all(int $roomId): array
    {
        return $this->get('/conferences/' . $roomId . '/sessions');
    }

    public function session(int $roomId, int $sessionId): array
    {
        return $this->get('/conferences/' . $roomId . '/sessions/' . $sessionId);
    }

    public function attendees(int $roomId, int $sessionId): array
    {
        return $this->get('/conferences/' . $roomId . '/sessions/' . $sessionId . '/attendees');
    }

    public function generatePdf(int $roomId, int $sessionId, string $lang): array
    {
        return $this->get('/conferences/' . $roomId . '/sessions/' . $sessionId . '/generate-pdf/' . $lang);
    }
}
