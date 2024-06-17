<?php
namespace App\Repositories;

require_once __DIR__ . '/../models/artist.php';
require_once __DIR__ . '/../models/venue.php';
use PDO;

class AdminRepository
{
    private $db;

    public function __construct()
    {
        include (__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    }

   
}
?>