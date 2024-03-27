<?php
session_start();
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];

            // Generate a password reset token and store it in the database
            $loginService = new \App\Services\LoginService();
            $resetToken = $loginService->generatePasswordResetToken($email);

            // Send the password reset email
            $mail = new PHPMailer;

            // Configure SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your@example.com';
            $mail->Password = 'your_password';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Set From and To addresses, subject, and body
            $mail->setFrom('from@example.com', 'Your Name');
            $mail->addAddress($email);
            $mail->Subject = 'Password Reset';
            $mail->Body = 'Click the following link to reset your password: http://example.com/reset_password.php?token=' . $resetToken;

            // Send the email
            if ($mail->send()) {
                // Email sent successfully
                header('Location: /forgot-password');
                exit();
            } else {
                // Failed to send email
                echo 'Error: ' . $mail->ErrorInfo;
            }
        }
        
        include '../views/forgot_password_sent.php';
    }


}

