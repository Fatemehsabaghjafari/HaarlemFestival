<?php

require_once __DIR__ . '/../services/historyservice.php';
require_once __DIR__ . '/controller.php';

class HistoryController extends Controller
{
    private $historyService;


    public function __construct()
    {
        $this->historyService = new \App\Services\HistoryService();

    }

    public function index()
    {      
        include '../views/history.php';
    }
}
