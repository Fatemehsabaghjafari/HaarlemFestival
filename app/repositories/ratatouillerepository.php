<?php
namespace App\Repositories;
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/restaurant.php';
use PDO;


class ratatouilleRepository {
    private $db;

    public function __construct() {
        require_once(__DIR__ . '/../config/dbconfig.php');
        //include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    }

}

