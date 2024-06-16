<?php

require_once __DIR__ . '/../services/personalProgramservice.php';
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../models/user.php';
require '../vendor/autoload.php';

class PersonalProgramController extends Controller
{
    private $personalProgramService;

    public function __construct()
    {
        $this->personalProgramService = new \App\Services\PersonalProgramService();
    }

    public function index()
    {   
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $userId = $_SESSION['user']->id;
        $personalProgram = $this->personalProgramService->getPersonalProgram($userId);

        // Convert to JSON
        // $personalProgram = json_encode($grouped, JSON_PRETTY_PRINT);

        // echo json_encode($personalProgram, JSON_PRETTY_PRINT);

        include '../views/personalProgram.php';
    }
}
