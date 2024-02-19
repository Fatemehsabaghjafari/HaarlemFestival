<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/personalProgramrepository.php';

class PersonalProgramService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\PersonalProgramRepository();
    }

  
}
