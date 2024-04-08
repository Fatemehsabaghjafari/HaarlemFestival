<?php
require '../vendor/autoload.php';

use chillerlan\QRCode\QRCode;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .ticket {
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px;
            margin: 20px auto;
        }
        .ticket-header {
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }
        .ticket-header img {
            margin: 0 auto;
            display: block;
        }
        .ticket-header h1 {
            margin: 0;
            text-transform: capitalize;
        }
        .ticket-info {
            margin-bottom: 20px;
        }
        .ticket-info p {
            margin: 5px 0;
        }
        .qr-code {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="ticket-header">
            <img src="img/Logo.png" alt="Logo" class="logo" height="45px">
            <h1><?php echo $eventType; ?> Ticket</h1>
        </div>
        <div class="ticket-info">
            <p>Name: <?php echo $firstName . " " . $lastName; ?></p>
            <p>Event: <?php echo $eventName; ?></p>
            <p>Date & Time: <?php echo $dateTime; ?></p>
        </div>
        <div class="qr-code">
            <?php echo '<img src="'.(new QRCode)->render($qrCode).'" alt="QR Code" height="200px" />'; ?>
        </div>
    </div>
</body>
</html>