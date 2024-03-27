<?php

require_once __DIR__ . '/../services/toujoursservice.php';
require_once __DIR__ . '/../services/yummyservice.php';
require_once __DIR__ . '/controller.php';

class ToujoursController extends Controller
{
    private $toujoursService;
    private $yummiService;


    public function __construct()
    {
        $this->toujoursService = new \App\Services\ToujoursService();
        $this->yummiService = new \App\Services\YummyService();
    }

    public function index()
    {
        $Restaurants = $this->yummiService->getRestaurantById(5);
        include '../views/toujours.php';
    }
}
