<?php

namespace App\Services;

use Exception;

require_once __DIR__ . '/../repositories/PagesRepository.php';

class PagesService
{
    private $repository;
    public function __construct()
    {
        $this->repository = new \App\Repositories\PagesRepository();
    }

    public function listAllPages()
    {
        return $this->repository->listAllPages();
    }

    public function getPage($name)
    {
        return $this->repository->getPage($name);
    }

    public function updatePage($id, $name, $title, $body): bool
    {
        return $this->repository->updatePage($id, $name, $title, $body);
    }

    public function addPage($name, $title, $body): bool
    {
        if ($this->repository->getPageByName($name)) {
            throw new Exception('Page with the same URL already exists.');
        }
        return $this->repository->addPage($name, $title, $body);
    }

    public function deletePage($id)
    {
        return $this->repository->deletePage($id);
    }
}