<?php

namespace App\Models;

class User {
    public int $id;
    public string $username;
    public string $email;
    public string $password;
    public int $roleId;
    public ?string $img;
    public ?string $registrationDate;
    public ?string $resetTokenHash;
    public ?string $tokenExpireTime;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $phone;
    public ?string $address;

    public function verifyPassword(string $inputPassword): bool {
        // For production, use password_verify()
        return $inputPassword === $this->password;
    }

    public function getId(): int {
        return $this->id;
    }
}
