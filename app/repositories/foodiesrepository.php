<?php
namespace App\Repositories;
//require_once __DIR__ . '/../models/user.php';
use PDO;

class FoodiesRepository {
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    }
    
    
}
?>
