<?php

require_once __DIR__ . '/../services/artCultureservice.php';
require_once __DIR__ . '/controller.php';

class ArtCultureController extends Controller
{
    private $artcultureService;


    public function __construct()
    {
        $this->artcultureService = new \App\Services\ArtCultureService();

    }

    public function index()
    {      
        include '../views/artCulture.php';
    }
}
