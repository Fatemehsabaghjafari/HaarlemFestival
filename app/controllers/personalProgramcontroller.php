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
        $personalProgram = $this->personalProgramService->getPersonalProgram();

        // Convert to JSON
        // $personalProgram = json_encode($grouped, JSON_PRETTY_PRINT);

        // echo json_encode($personalProgram, JSON_PRETTY_PRINT);

        include '../views/personalProgram.php';
    }
}
