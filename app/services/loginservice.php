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
    public function generatePasswordResetToken($email) {
        // Generate a random token
        $token = bin2hex(random_bytes(32)); // Generate a 64-character hexadecimal token
    
        // Store the token in the database along with the user's email
        $this->repository->storePasswordResetToken($email, $token);
    
        return $token;
    }

}
