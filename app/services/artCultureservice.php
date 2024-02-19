<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/artCulturerepository.php';

class ArtCultureService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\ArtCultureRepository();
    }

  
}
