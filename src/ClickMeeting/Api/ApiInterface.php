<?php
namespace ClickMeeting\Api;

use ClickMeeting\Client;

/**
 * Interface ApiInterface
 * @package ClickMeeting\Api
 */
interface ApiInterface
{
    /**
     * ApiInterface constructor.
     * @param Client $client
     */
    public function __construct(Client $client);
}
