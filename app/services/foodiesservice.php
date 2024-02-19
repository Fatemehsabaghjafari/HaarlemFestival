<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/foodiesrepository.php';

class FoodiesService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\FoodiesRepository();
    }

  
}
