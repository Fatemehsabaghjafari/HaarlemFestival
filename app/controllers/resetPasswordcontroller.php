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
        if (isset($_GET['token'])) {
            $token = $_GET["token"]; // Retrieve the token from the URL parameter
           // echo "Token from URL: " . $token;
            $tokenHash = hash("sha256", $token);
            // Check if the token exists in the database and is not expired
            $passwordReset = $this->loginService->getPasswordResetToken($tokenHash);

           // if ($passwordReset && strtotime($passwordReset['expiry']) > time()) {
                // Token is valid, allow the user to reset their password
                include '../views/reset_password_form.php'; // Display the password reset form
            //}
        }else{
            echo 'Invalid or expired token.';
        }   

    }

    public function updatePassword()
    {
        // Retrieve the token and new password from the form submission
        $token = $_POST['token'];
        $newPassword = $_POST['new_password'];

        // Update the password in the database
        $this->loginService->resetPassword($token, $newPassword);

        // Inform the user that their password has been successfully reset
        include '../views/password_reset_success.php';
    }
}

// Handle the reset password process
$resetPasswordController = new ResetPasswordController();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $resetPasswordController->reset();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resetPasswordController->updatePassword();
}
