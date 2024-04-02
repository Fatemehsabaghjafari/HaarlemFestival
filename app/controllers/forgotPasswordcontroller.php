<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require __DIR__ . '/controller.php';
require_once __DIR__ . '/../vendor/autoload.php';
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

        $this->loginService->storePasswordResetToken($email, $token, $expiry);

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Username = 'your@example.com';
        $mail->Password = 'your_password';
        $mail->Port = 587;
        $mail->isHTML(true);
        $mail->setFrom("no-reply@example.com");

        $mail->addAddress($email);
        $mail->Subject = 'Password Reset';
        $mail->Body = 'Click the following link to reset your password: http://example.com/reset_password.php?token=' . $token;
        try {
            $mail->send();
            // Email sent successfully
            header('Location: /forgot-password');
            exit();
        } 
        catch(Exception $e) {
            // Failed to send email
            echo 'Error: ' . $mail->ErrorInfo;
        }
        
        include '../views/forgot_password_sent.php';
    }


}

