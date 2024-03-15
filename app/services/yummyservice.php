<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/yummyrepository.php';

class YummyService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\YummyRepository();
    }

    public function getAllRestaurantsItems()
    {
        return $this->repository->getAllRestaurantsItems();
    }
}
