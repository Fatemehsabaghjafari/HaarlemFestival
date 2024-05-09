<?php

require_once __DIR__ . '/../services/userAdminservice.php';
require_once __DIR__ . '/../services/loginservice.php';
require_once __DIR__ . '/controller.php';

class UserAdminApiController extends Controller
{
    private $userAdminService;
    private $loginService;
    private $errorMsg;

    public function __construct()
    {
        $this->userAdminService = new \App\Services\UserAdminService();
        $this->loginService = new \App\Services\LoginService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->handleGetRequest();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();
        }
    }

    private function handleGetRequest()
    {
        $users = $this->userAdminService->getAllUsers();
        $myJSON = json_encode($users);
        echo $myJSON;
    }

    private function handlePostRequest()
    {
        if (!isset($_POST['action'])) {
            $this->respondWithError(400, 'Invalid request data');
        }

        switch ($_POST['action']) {
            case 'delete-user':
                $this->handleDeleteUser();
                break;
            case 'add-user':
                $this->handleAddUser();
                break;
            case 'edit-user':
                $this->handleEditUser();
                break;
            default:
                $this->respondWithError(400, 'Invalid action');
        }
    }

    private function handleDeleteUser()
    {
        if (!isset($_POST['userId'])) {
            $this->respondWithError(400, 'User ID not provided');
        }

        $userId = $_POST['userId'];
        $result = $this->userAdminService->deleteUserById($userId);

        $message = $result ? "user deleted successfully!" : "Failed to delete user.";
        echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $message]);
    }

    private function handleAddUser()
    {
        $requiredParams = ['email', 'username', 'password', 'role'];
        if (!$this->checkRequiredParameters($requiredParams)) {
            $this->respondWithError(400, 'Missing required parameters');
        }

        if (!isset($_FILES['img'])) {
            $this->respondWithError(400, 'No image uploaded');
        }

        $image = $_FILES['img'];
        $uploadPath = __DIR__ . '/../public/img/';
        $filename = $image['name'];
        $targetPath = $uploadPath . basename($filename);

        if (!move_uploaded_file($image['tmp_name'], $targetPath)) {
            $this->respondWithError(400, 'Failed to upload image');
        }

        $role = $_POST['role'];
        $password = filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $username = filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

        $result = $this->userAdminService->addUser($email, $username, $hashedPassword, $role, "/img/" . $filename);
        $message = $result ? 'User added successfully' : 'Failed to add user';
        echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $message]);
    }

    private function handleEditUser()
    {
        $requiredParams = ['userId', 'email', 'username', 'role'];
        if (!$this->checkRequiredParameters($requiredParams)) {
            $this->respondWithError(400, 'Missing required parameters');
        }

        if (!isset($_FILES['img'])) {
            $this->respondWithError(400, 'No image uploaded');
        }

        $image = $_FILES['img'];
        $uploadPath = __DIR__ . '/../public/img/';
        $filename = $image['name'];
        $targetPath = $uploadPath . basename($filename);

        if (!move_uploaded_file($image['tmp_name'], $targetPath)) {
            $this->respondWithError(400, 'Failed to upload image');
        }

        $userId = $_POST['userId'];
        $role = $_POST['role'];
        $username = filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

        if ($this->loginService->isUsernameTaken($username)) {
            $this->errorMsg = "Username is already in use.";
            return;
        }

        if ($this->loginService->isEmailTaken($email)) {
            $this->errorMsg = "Email is already in use.";
            return;
        }

        $result = $this->userAdminService->updateUser($userId, $email, $username, $role, "/img/" . $filename);
        $message = $result ? 'User updated successfully' : 'Failed to update user';
        echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $message]);
    }

    private function checkRequiredParameters($params)
    {
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                return false;
            }
        }
        return true;
    }

    private function respondWithError($code, $message)
    {
        http_response_code($code);
        echo json_encode(['status' => 'error', 'message' => $message]);
        exit;
    }
}
