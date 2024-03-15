<?php

require_once __DIR__ . '/../services/yummyservice.php';
require_once __DIR__ . '/controller.php';

class YummyController extends Controller
{
    private $yummiService;


    public function __construct()
    {
        $this->yummiService = new \App\Services\YummyService();

    }

    public function index()
    {      
        $RestaurantsItems = $this->yummiService->getAllRestaurantsItems();
        include '../views/yummy.php';
    }
}
