<?php

namespace ClickMeeting\Api;

class TimeZones extends AbstractApi
{
    public function all(): array
    {
        return $this->get('/time_zone_list');
    }

    public function byCountry(string $country): array
    {
        return $this->get('/time_zone_list/' . $country);
    }
}
