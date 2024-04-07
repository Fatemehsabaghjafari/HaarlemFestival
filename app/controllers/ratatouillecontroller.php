<?php
require_once __DIR__ . '/../services/yummyservice.php';
require_once __DIR__ . '/../services/ratatouilleservice.php';
require_once __DIR__ . '/controller.php';

class RatatouilleController extends Controller
{
    private $ratatouilleService;
    private $yummiService;

    public function __construct()
    {
        $this->ratatouilleService = new \App\Services\RatatouilleService();
        $this->yummiService = new \App\Services\YummyService();
    }

    public function index()
    {   
        $Restaurant = $this->yummiService->getRestaurantById(6);
        include '../views/ratatouille.php';
    }
}
