<?php

namespace ClickMeeting\Api;

use ClickMeeting\Client;

interface ApiInterface
{
    public function __construct(Client $client);
}
