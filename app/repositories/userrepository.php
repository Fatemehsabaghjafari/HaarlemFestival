<?php
namespace App\Repositories;

require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/role.php';
use PDO;
use PDOException;

class UserRepository
{
    private $db;

    public function __construct()
    {
        include (__DIR__ . '/../config/dbconfig.php');
        try {
            $this->db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle the exception as needed
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function isUsernameTakenByOtherUsers($userId, $username)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM users WHERE username = ? AND id != ?');
        $stmt->execute([$username, $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    public function isEmailTakenByOtherUsers($userId, $email)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM users WHERE email = ? AND id != ?');
        $stmt->execute([$email, $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    public function getAllUsers()
    {
        $stmt = $this->db->prepare('SELECT u.*, r.role FROM users u INNER JOIN roles r ON u.roleId = r.roleId');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ); // Fetch data as objects
        return $users;
    }

    public function getRoles()
    {
        try {
            $stmt = $this->db->query("SELECT role FROM roles");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception as needed
            return [];
        }
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

    public function storePasswordResetToken($email, $tokenHash, $expiry): bool
    {
        $sql = "UPDATE users SET resetTokenHash = ?, tokenExpireTime = ? WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tokenHash, $expiry, $email]);

        return $stmt->rowCount() > 0;
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
        $user = $this->getPasswordResetToken($token);

        if ($user && strtotime($user['tokenExpireTime']) > time()) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare('UPDATE users SET password = ?, resetTokenHash = NULL, tokenExpireTime = NULL WHERE resetTokenHash = ?');
            $stmt->execute([$hashedPassword, $token]);
            return true;
        } else {
            return false;
        }
    }
    private function validateUserInputs($email, $username, $role, $image, &$errorMessage = null)
    {
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "Invalid email format.";
            return false;
        }

        // Validate username
        if (strlen($username) < 3 || strlen($username) > 20) {
            $errorMessage = "Username must be between 3 and 20 characters.";
            return false;
        }

        // Validate role (assuming $roles is an array of valid roles)
        $stmt = $this->db->prepare('SELECT roleId FROM roles WHERE role = ?');
        $stmt->execute([$role]);
        if (!$stmt->fetchColumn()) {
            $errorMessage = "Invalid role selected.";
            return false;
        }

        // Validate image if provided
        if ($image) {
            $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $imageType = mime_content_type($image['tmp_name']);
            if (!in_array($imageType, $allowedImageTypes)) {
                $errorMessage = "Invalid image type. Allowed types are JPEG, PNG, GIF.";
                return false;
            }
        }

        return true;
    }

    public function updateUser($userId, $email, $username, $role, $image, &$errorMessage = null)
    {
        // Validate inputs
        if (!$this->validateUserInputs($email, $username, $role, $image, $errorMessage)) {
            return false;
        }

        try {
            $stmt = $this->db->prepare('SELECT roleId FROM roles WHERE role = ?');
            $stmt->execute([$role]);
            $roleId = $stmt->fetchColumn();

            $stmt = $this->db->prepare("UPDATE users SET email = :email, username = :username, roleId = :roleId, img = :img WHERE id = :userId");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':roleId', $roleId);
            $stmt->bindParam(':img', $image);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log the error (optional)
            error_log($e->getMessage());
            $errorMessage = "Database error: " . $e->getMessage();
            return false;
        }
    }


    public function addUser($email, $username, $password, $role, $image, &$errorMessage = null)
    {
        // Validate inputs
        if (!$this->validateUserInputs($email, $username, $role, $image, $errorMessage)) {
            return false;
        }
    
        // Check for existing username and email
        if ($this->isUsernameTaken($username) || $this->isEmailTaken($email)) {
            $errorMessage = "Username or email already taken.";
            return false;
        }
    
        try {
            $stmt = $this->db->prepare('SELECT roleId FROM roles WHERE role = ?');
            $stmt->execute([$role]);
            $roleId = $stmt->fetchColumn();
    
            $registrationDate = date("Y-m-d H:i:s");
            $stmt = $this->db->prepare("INSERT INTO users (email, username, password, roleId, registrationDate, img) VALUES (:email, :username, :password, :roleId, :registrationDate, :img)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':roleId', $roleId);
            $stmt->bindParam(':registrationDate', $registrationDate);
            $stmt->bindParam(':img', $image);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log the error (optional)
            error_log($e->getMessage());
            $errorMessage = "Database error: " . $e->getMessage();
            return false;
        }
    }
    

    public function deleteUserById($userId)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function setUserDetails($userId, $firstName, $lastName, $address, $phone)
    {
        try {
            $stmt = $this->db->prepare("UPDATE users SET firstName = :firstName, lastName = :lastName, phone = :phone, address = :address WHERE id = :userId");
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
