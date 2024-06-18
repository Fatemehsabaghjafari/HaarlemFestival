<?php
session_start();

require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';

class ResetPasswordController extends Controller
{
    private $loginService;

    public function __construct()
    {
        $this->loginService = new \App\Services\LoginService();
    }

    public function reset()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['token'])) {
                $token = $_GET["token"]; // Retrieve the token from the URL parameter
                // echo "Token from URL: " . $token;
                $tokenHash = hash("sha256", $token);
                // Check if the token exists in the database and is not expired
                $passwordReset = $this->loginService->getPasswordResetToken($token);

                if ($passwordReset && strtotime($passwordReset['tokenExpireTime']) > time()) {
                    // Token is valid, allow the user to reset their password
                    include '../views/reset_password_form.php'; // Display the password reset form
                } else {
                    $responseMessage = [ "success" => false, "message" => "Invalid or expired token." ];
                    include '../views/forgot_password_response.php';
                }
            } else{
                $responseMessage = [ "success" => false, "message" => "Invalid or expired token." ];
                include '../views/forgot_password_response.php';
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->updatePassword();
        }
    }

    public function updatePassword()
    {
        // Retrieve the token and new password from the form submission
        $token = $_POST['token'];
        $newPassword = $_POST['new_password'];

        // Update the password in the database
        $result = $this->loginService->resetPassword($token, $newPassword);

        if ($result) {
            $responseMessage = [ "success" => true, "message" => "Your password has been successfully reset." ];
            include '../views/forgot_password_response.php';
        } else {
            $responseMessage = [ "success" => false, "message" => "Couldn't reset your password" ];
            include '../views/forgot_password_response.php';
        }
    }
}