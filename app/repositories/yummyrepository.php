<?php
namespace App\Repositories;
//require_once __DIR__ . '/../models/user.php';
use PDO;

class YummyRepository {
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }

    public function getAllRestaurantsItems()
    {
    $stmt = $this->db->prepare("SELECT * FROM yummyRestaurants");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
    }   
}

