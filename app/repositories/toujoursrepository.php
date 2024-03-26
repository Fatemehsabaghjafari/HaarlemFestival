<?php
namespace App\Repositories;
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/restaurant.php';
use PDO;

class toujoursRepository {
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }

}

