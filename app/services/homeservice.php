<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/homerepository.php';

class HomeService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\HomeRepository();
    }

  
}
