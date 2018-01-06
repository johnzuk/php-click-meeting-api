<?php
namespace ClickMeeting\Api;

/**
 * Class Files
 * @package ClickMeeting\Api
 */
class Files extends AbstractApi
{
    /**
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function all()
    {
        return $this->get('file-library');
    }

    /**
     * @param array $file
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function add($file = [])
    {
        return $this->post('file-library', [], [], $file);
    }

    /**
     * @param $roomId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function listOfRoom($roomId)
    {
        return $this->get('file-library/conferences/'.$roomId);
    }

    /**
     * @param $roomId
     * @param array $file
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function addToRoom($roomId, $file = [])
    {
        return $this->post('file-library/conferences/'.$roomId, [], [], $file);
    }

    /**
     * @param int $fileId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function details($fileId)
    {
        return $this->get('file-library/'.$fileId);
    }

    /**
     * @param int $fileId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function delete($fileId)
    {
        return $this->deleteRequest('file-library/'.$fileId);
    }

    /**
     * @param int $fileId
     * @return array
     * @throws \ClickMeeting\Exception\InvalidResponseContentType
     * @throws \Http\Client\Exception
     */
    public function getContent($fileId)
    {
        return $this->get('file-library/'.$fileId.'/download');
    }
}
