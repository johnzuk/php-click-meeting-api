<?php

namespace ClickMeeting\Api\Conferences;

use ClickMeeting\Api\AbstractApi;

class Recordings extends AbstractApi
{
    public function all(int $roomId): array
    {
        return $this->get('/conferences/' . $roomId . '/recordings');
    }

    public function deleteAll(int $roomId): array
    {
        return $this->deleteRequest('/conferences/' . $roomId . '/recordings');
    }

    public function delete(int $roomId, int $recordingId): array
    {
        return $this->deleteRequest('/conferences/' . $roomId . '/recordings/' . $recordingId);
    }
}
