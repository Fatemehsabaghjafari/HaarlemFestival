<?php
namespace App\Repositories;

require_once __DIR__ . '/../models/user.php';
use PDO;

class UserRepository
{
    private $db;

    public function __construct()
    {
        include (__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }

    public function getAllUsers()
    {
        $stmt = $this->db->prepare('SELECT * FROM users');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\\Models\\User');
        return $users;
    }

    public function insertUser($username, $email, $hashedPassword)
    {
        $stmt = $this->db->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$username, $email, $hashedPassword]);
    }

    public function getUserById($userId)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function isUsernameTaken($username)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    public function isEmailTaken($email)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    public function storePasswordResetToken($email, $tokenHash, $expiry)
    {
        $sql = "UPDATE users SET resetTokenHash = ?, tokenExpireTime = ? WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tokenHash, $expiry, $email]);
    }

    public function getPasswordResetToken($token)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE resetTokenHash = ?');
        $stmt->execute([$token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function resetPassword($token, $newPassword)
    {
        // Check if the token exists and is not expired
        $user = $this->getPasswordResetToken($token);

        if ($user && strtotime($user['tokenExpireTime']) > time()) {
            // Token is valid, update the user's password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare('UPDATE users SET password = ?, resetTokenHash = NULL, tokenExpireTime = NULL WHERE resetTokenHash = ?');
            $stmt->execute([$hashedPassword, $token]);
            return true; // Password reset successful
        } else {
            return false; // Token is invalid or expired
        }
    }
    public function updateUser($userId, $email, $username, $roleId, $image)
    {
        try {
            $stmt = $this->db->prepare("UPDATE dbo.users SET email = :email, username = :username, roleId = :roleId, img = :img WHERE id = :userId");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':roleId', $roleId);
            $stmt->bindParam(':img', $image);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return true; // Success
        } catch (PDOException $e) {
            return false; // Error
        }
    }

    public function addUser($email, $username, $password, $roleId, $image)
    {
        try {
            $registrationDate = date("Y-m-d H:i:s");
            $stmt = $this->db->prepare("INSERT INTO dbo.users (email, username, password, roleId, registrationDate, img) VALUES (:email, :username, :password, :roleId, :registrationDate, :img)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':roleId', $roleId);
            $stmt->bindParam(':registrationDate', $registrationDate);
            $stmt->bindParam(':img', $image);
            $stmt->execute();
            return true; // Success
        } catch (PDOException $e) {
            return false; // Error
        }
    }

    public function deleteUserById($userId)
    {
        $stmt = $this->db->prepare("DELETE FROM dbo.users WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        // Optionally, you can return true or false based on the success of the deletion
        return $stmt->rowCount() > 0; // Returns true if at least one row was affected
    }

    public function setUserDetails($userId, $firstName, $lastName, $address, $phone)
    {
        try {
            $stmt = $this->db->prepare("UPDATE dbo.users SET firstName = :firstName, lastName = :lastName, phone = :phone, address = :address WHERE id = :userId");
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}