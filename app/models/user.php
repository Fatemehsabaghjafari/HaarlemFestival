<?php
namespace App\Models;
class User {
public $id;
public $username;
public $email;
public $password;


public function verifyPassword($inputPassword) {
    // For simplicity, in a real-world scenario, use password_hash() and password_verify()
    return $inputPassword === $this->password;
}
}