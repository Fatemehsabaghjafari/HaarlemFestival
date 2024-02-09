<?php
namespace App\Repositories;
require_once __DIR__ . '/../models/user.php';
use PDO;

class HomeRepository {
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:host=$servername;dbname=$dbname", $username, $password);
    }
    
    
}
?>
