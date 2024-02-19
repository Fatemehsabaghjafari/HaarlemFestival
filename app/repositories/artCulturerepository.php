<?php
namespace App\Repositories;
//require_once __DIR__ . '/../models/user.php';
use PDO;

class ArtCultureRepository {
    private $db;

    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }
    
    
}
?>
