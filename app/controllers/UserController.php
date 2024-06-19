<?php

namespace app\controllers;
use Controller;

require_once __DIR__ . '/../controllers/controller.php';
require_once __DIR__ . '/../services/userAdminservice.php';

class UserController extends Controller
{
    private $userAdminService;

    public function __construct()
    {
        $this->userAdminService = new \App\Services\UserAdminService();
    }

    public function getUserById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $userId = $_GET['id'];
            $user = $this->userAdminService->getUserById($userId);
            $result = json_encode($user);

            if ($result) {
                http_response_code(200);
                echo $result;
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'failed']);
            }
        }
    }
}