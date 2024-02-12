<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/userrepository.php';

class LoginService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\UserRepository();
    }

    public function getAllUsers()
    {
        return $this->repository->getAllUsers();
    }

    public function insertUser($username, $hashedPassword){
        return $this->repository->insertUser($username, $hashedPassword);
    }

}
