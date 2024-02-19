<?php

namespace App\Services;

require_once __DIR__ . '/../repositories/historyrepository.php';

class HistoryService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new \App\Repositories\HistoryRepository();
    }

  
}
