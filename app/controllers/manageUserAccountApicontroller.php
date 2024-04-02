<?php
require_once __DIR__ . '/../models/user.php';
session_start();
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';


class ManageUserAccountApiController extends Controller
{

    private $loginService;

    public function __construct()
    {
        $this->loginService = new \App\Services\LoginService();
    }

    public function index()
    {
        // Check if the request method is GET
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Retrieve user ID from the session
            $userId = isset($_SESSION['user']) ? $_SESSION['user']->id : null;
            // If user ID exists, retrieve user data
            if ($userId) {
                $user = $this->loginService->getUserById($userId);
                $myJSON = json_encode($user);
                echo $myJSON;
                return; // Stop further execution
            } else {
                // If user is not logged in, return null
                echo json_encode(null);
                return; // Stop further execution
            }
        }

    }


}
