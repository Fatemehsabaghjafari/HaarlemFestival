<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/loginservice.php';

class ForgotPasswordController extends Controller
{
    private $loginService;

    public function __construct()
    {
        $this->loginService = new \App\Services\LoginService();
    }

    public function index()
    {
        $email = $_POST['email'];

        $token = bin2hex(random_bytes(16));
        $tokenHash = hash("sha256", $token);

        $expiry = date("Y-m-d H:i:s", time() + 60 * 30); // Corrected datetime format

        $result = $this->loginService->storePasswordResetToken($email, $token, $expiry);

        if ($result === false) {
            $responseMessage = [ "success" => false, "message" => "There is no account associated with this email address" ];
            include '../views/forgot_password_response.php';
            exit();
        }

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'haarlemfestival5@gmail.com';
        $mail->Password = 'svwa oxwy leip kwtt';
        $mail->Port = 465;
        $mail->isHTML(true);
        $mail->setFrom("haarlemfestival5@gmail.com");

        $mail->addAddress($email);
        $mail->Subject = 'Password Reset';
        $mail->Body = 'Click the following link to reset your password: http://localhost/resetPassword?token=' . $token;
        try {
            $mail->send();
            $responseMessage = [ "success" => true, "message" => "Password reset link sent to email." ];
            include '../views/forgot_password_response.php';
            exit();
        } catch (Exception $e) {
            // Failed to send email
            $responseMessage = [ "success" => false, "message" => $mail->ErrorInfo ];
            include '../views/forgot_password_response.php';
            exit();
        }
    }
}

