<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/toujoursrepository.php';

class ToujoursService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\ToujoursRepository();
    }

  
}
