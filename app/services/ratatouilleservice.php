<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/ratatouillerepository.php';

class RatatouilleService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\RatatouilleRepository();
    }

  
}
