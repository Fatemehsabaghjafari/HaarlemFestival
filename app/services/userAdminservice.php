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
    public function getUserById($userId){
        return $this->repository->getUserById($userId);
    }
    public function getRoles(){
        return $this->repository->getRoles();
    }
    public function addUser($email, $username, $password, $role, $image){
        return $this->repository->addUser($email, $username, $password, $role, $image);
    }
    public function deleteUserById($userId){
        return $this->repository->deleteUserById($userId);
    }
    public function updateUser($userId, $email, $username, $role, $image){
        return $this->repository->updateUser($userId, $email, $username, $role, $image);
    }
    public function setUserDetails($userId, $firstName, $lastName, $address, $phone){
        return $this->repository->setUserDetails($userId, $firstName, $lastName, $address, $phone);
    }
    public function isUsernameTakenByOtherUsers($userId, $username)
    {
       return $this->repository->isUsernameTakenByOtherUsers($userId, $username);
    }
    
    public function isEmailTakenByOtherUsers($userId, $email)
    {
        return $this->repository->isEmailTakenByOtherUsers($userId, $email);
    }
}