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

    public function insertUser($username, $hashedPassword) {
        $stmt = $this->db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->execute([$username, $hashedPassword]);
    }
    
}