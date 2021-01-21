<?php

namespace ClickMeeting\Api;

class Contacts extends AbstractApi
{
    public function add(array $contact): array
    {
        return $this->post('/contacts', $contact);
    }
}
