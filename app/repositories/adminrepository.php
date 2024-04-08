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
        $this->db = new PDO("$type:server=$servername;Database=$dbname", $username, $password);
    }

   
}
?>