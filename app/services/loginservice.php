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

    public function insertUser($username, $email, $hashedPassword){
        return $this->repository->insertUser($username, $email, $hashedPassword);
    }
    public function isUsernameTaken($username) {
       return $this->repository->isUsernameTaken($username);
    }

    public function isEmailTaken($email) {
       return $this->repository->isEmailTaken($email);
    }
    public function storePasswordResetToken($email, $tokenHash, $expiry):bool {
        return $this->repository->storePasswordResetToken($email, $tokenHash, $expiry);
    }
    public function getUserById($userId){
        return $this->repository->getUserById($userId);
    }
    public function getPasswordResetToken($token){
        return $this->repository->getPasswordResetToken($token);
    }
    public function resetPassword($token, $newPassword): bool
    {
        return $this->repository->resetPassword($token, $newPassword);
    }
}
