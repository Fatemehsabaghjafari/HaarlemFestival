<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/userrepository.php';

class UserAdminservice
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
    public function addUser($email, $username, $password, $roleId, $image){
        $this->repository->addUser($email, $username, $password, $roleId, $image);
    }
    public function deleteUserById($userId){
        $this->repository->deleteUserById($userId);
    }
    public function updateUser($userId, $email, $username, $roleId, $image){
        $this->repository->updateUser($userId, $email, $username, $roleId, $image);
    }
    public function setUserDetails($userId, $firstName, $lastName, $address, $phone){
        $this->repository->setUserDetails($userId, $firstName, $lastName, $address, $phone);
    }
}