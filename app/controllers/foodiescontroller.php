<?php

require_once __DIR__ . '/../services/foodiesservice.php';
require_once __DIR__ . '/controller.php';

class FoodiesController extends Controller
{
    private $foodiesService;

    public function __construct()
    {
        $this->foodiesService = new \App\Services\FoodiesService();

    }

    public function index()
    {      
        include '../views/foodies.php';
    }
}
