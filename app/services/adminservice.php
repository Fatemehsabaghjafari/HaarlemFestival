<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/adminrepository.php';

class AdminService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\AdminRepository();
    }





   
}
