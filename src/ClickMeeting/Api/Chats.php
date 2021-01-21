<?php

namespace ClickMeeting\Api;

class Chats extends AbstractApi
{
    public function all(): array
    {
        return $this->get('/chats');
    }

    public function details(int $sessionId): array
    {
        return $this->get('/chats/' . $sessionId);
    }
}
