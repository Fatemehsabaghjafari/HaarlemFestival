<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Mpdf\Mpdf;

require '../vendor/autoload.php';

class EmailService {
    public function sendEmail($recipientEmail, $subject, $pdfContent) {
        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPSecure = 'ssl';
            $mail->Username = 'haarlemfestival5@gmail.com';
            $mail->Password = 'svwa oxwy leip kwtt';
            $mail->Port = 465;
            
            $mail->setFrom('haarlemfestival5@gmail.com');
            $mail->addAddress($recipientEmail);

            $mail->addStringAttachment($pdfContent, 'attachment.pdf', 'base64', 'application/pdf');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $subject . " is attached.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}