<?php

namespace ClickMeeting\Api;

class PhoneGateways extends AbstractApi
{
    public function all(): array
    {
        return $this->get('/phone_gateways');
    }
}
