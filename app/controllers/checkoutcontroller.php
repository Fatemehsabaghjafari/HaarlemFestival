<?php

require_once __DIR__ . '/../services/personalProgramservice.php';
require_once __DIR__ . '/controller.php';
require '../vendor/autoload.php';

use Mollie\Api\MollieApiClient;

class CheckoutController extends Controller
{
    private $personalProgramService;

    public function __construct()
    {
        $this->personalProgramService = new \App\Services\PersonalProgramService();
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey("test_dHar4XY7LxsDOtmnkVtjNVWXLSlXsM");
    }

    public function index()
    {      
        $personalProgram = $this->personalProgramService->getPersonalProgram(1, true, true);

        // Convert to JSON
        // $personalProgram = json_encode($grouped, JSON_PRETTY_PRINT);

        // echo json_encode($personalProgram, JSON_PRETTY_PRINT);

        include '../views/checkout.php';
    }
}
