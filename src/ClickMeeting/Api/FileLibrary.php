<?php

namespace ClickMeeting\Api;

use Psr\Http\Message\ResponseInterface;
use SplFileObject;

class FileLibrary extends AbstractApi
{
    public function all(): array
    {
        return $this->get('/file-library');
    }

    public function file(int $fileId): array
    {
        return $this->get('/file-library/' . $fileId);
    }

    public function download(int $fileId): ResponseInterface
    {
        return $this->getAsResponse('/file-library/' . $fileId . '/download');
    }

    public function add(SplFileObject $file): array
    {
        return $this->upload('/file-library', $file, 'uploaded');
    }

    public function listOfRoom(int $roomId): array
    {
        return $this->get('/file-library/conferences/' . $roomId);
    }

    public function addToRoom(int $roomId, SplFileObject $file): array
    {
        return $this->upload('/file-library/conferences/' . $roomId, $file, 'uploaded');
    }

    public function delete(int $fileId): array
    {
        return $this->deleteRequest('/file-library/' . $fileId);
    }
}
