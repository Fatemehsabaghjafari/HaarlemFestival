<?php
namespace App\Repositories;
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/restaurant.php';
use PDO;

class toujoursRepository {
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    }

}

