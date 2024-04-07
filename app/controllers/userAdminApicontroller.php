<?php

require_once __DIR__ . '/../services/userAdminservice.php';
require_once __DIR__ . '/../services/loginservice.php';
require_once __DIR__ . '/controller.php';

class UserAdminApiController extends Controller
{
    private $adminService;
    private $loginService;
    private $errorMsg;

    public function __construct()
    {
        $this->adminService = new \App\Services\UserAdminService();
        $this->loginService = new \App\Services\LoginService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $users = $this->adminService->getAllUsers();
            $myJSON = json_encode($users);
            echo $myJSON;
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();
        }
    }
    private function handlePostRequest()
    {
        //$postData = json_decode(file_get_contents("php://input"), true);

        if (!isset($_POST['action'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid request data']);
            exit;
        }

        switch ($_POST['action']) {

            case 'delete-user':
                if (!isset($_POST['userId'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'User ID not provided']);
                    exit;
                }

                $userId = $_POST['userId'];

                $result = $this->adminService->deleteUserById($userId);

                if ($result) {
                    $display_message = "user deleted successfully!";
                    echo json_encode(['status' => 'success', 'message' => $display_message]);
                } else {
                    $display_message = "Failed to delete user.";
                    echo json_encode(['status' => 'error', 'message' => $display_message]);
                }
                break;

            case 'add-user':
                // Check if all required parameters are provided
                if (!isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['roleId'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
                    exit;
                }

                // Check if image file is uploaded
                if (isset($_FILES['img'])) {
                    $image = $_FILES['img'];
                    $uploadPath = __DIR__ . '/../public/img/';
                    $filename = $image['name'];
                    $targetPath = $uploadPath . basename($filename);

                    // Move uploaded file to desired directory
                    if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                        // Image upload successful, now insert user data into database
                        // $email = $_POST['email'];
                        // $username = $_POST['username'];
                        // $password = $_POST['password'];
                        $roleId = $_POST['roleId'];

                        $password = filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS);

                        // Hash the password before storing it
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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

                        if (strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0) {
                            $this->errorMsg = "The captcha code isn't correct. Please try again";
                            include '../views/register.php';
                            return;
                        }
                        // Insert user data into the database
                        $result = $this->adminService->addUser($email, $username, $hashedPassword, $roleId, "/img/" . $filename);

                        if ($result) {
                            // Success response
                            echo json_encode(['status' => 'success', 'message' => 'User added successfully']);
                        } else {
                            // Error response
                            echo json_encode(['status' => 'error', 'message' => 'Failed to add user']);
                        }
                    } else {
                        // Error handling for file upload failure
                        echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
                    }
                } else {
                    // Error handling for no image uploaded
                    echo json_encode(['status' => 'error', 'message' => 'No image uploaded']);
                }
                break;



            case 'edit-user':
                // Check if all required parameters are provided
                if (!isset($_POST['userId'], $_POST['email'], $_POST['username'], $_POST['roleId'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
                    exit;
                }

                // Check if image file is uploaded
                if (isset($_FILES['img'])) {
                    $image = $_FILES['img'];
                    $uploadPath = __DIR__ . '/../public/img/';
                    $filename = $image['name'];
                    $targetPath = $uploadPath . basename($filename);

                    // Move uploaded file to desired directory
                    if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                        // Image upload successful, now update user data in the database
                        $userId = $_POST['userId'];
                        // $email = $_POST['email'];
                        // $username = $_POST['username'];
                        $roleId = $_POST['roleId'];

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

                        // Update user data in the database
                        $result = $this->adminService->updateUser($userId, $email, $username, $roleId, "/img/" . $filename);

                        if ($result) {
                            // Success response
                            echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
                        } else {
                            // Error response
                            echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
                        }
                    } else {
                        // Error handling for file upload failure
                        echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
                    }
                } else {
                    // Error handling for no image uploaded
                    echo json_encode(['status' => 'error', 'message' => 'No image uploaded']);
                }
                break;



            default:
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
                exit;
        }
    }


}