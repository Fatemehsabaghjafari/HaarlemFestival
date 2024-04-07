<?php
namespace App\Repositories;

require_once __DIR__ . '/../models/user.php';
use PDO;

class UserRepository {
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }

    public function getAllUsers() {
        $stmt = $this->db->prepare('SELECT * FROM users');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\\Models\\User');
        return $users;
    }

    public function insertUser($username, $email, $hashedPassword) {
        $stmt = $this->db->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$username, $email, $hashedPassword]);
    }

    public function getUserById($userId) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function isUsernameTaken($username) {
        $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    public function isEmailTaken($email) {
        $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    public function storePasswordResetToken($email, $tokenHash, $expiry) {
        $sql = "UPDATE users SET resetTokenHash = ?, tokenExpireTime = ? WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$tokenHash, $expiry, $email]);
    }
    
}