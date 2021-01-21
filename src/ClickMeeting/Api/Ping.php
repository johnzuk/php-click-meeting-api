<?php

namespace ClickMeeting\Api;

class Ping extends AbstractApi
{
    public function ping(): array
    {
        return $this->get('/ping');
    }
}
