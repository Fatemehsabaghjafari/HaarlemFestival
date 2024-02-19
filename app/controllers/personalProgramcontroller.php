<?php

require_once __DIR__ . '/../services/personalProgramservice.php';
require_once __DIR__ . '/controller.php';

class PersonalProgramController extends Controller
{
    private $personalProgramService;


    public function __construct()
    {
        $this->personalProgramService = new \App\Services\PersonalProgramService();

    }

    public function index()
    {      
        include '../views/personalProgram.php';
    }
}
