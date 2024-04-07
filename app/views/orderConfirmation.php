<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Haarlem</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ced7be0a6d.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/personalProgram.css">
    <link rel="stylesheet" href="css/checkout.css">
</head>

<body>
    <?php
        include __DIR__ . '/header.php';
    ?>


    <div class="order-confirmation-container">
        <?php if ($isOrderCompleted): ?>
            <i class="fa-solid fa-circle-check"></i>
            <h1>Order Confirmation</h1>
            <p>The ticket and invoice has been sent to your email address</p>
            <div class="buttons">
                <a href="/personalProgram" class="btn btn-primary">Download Ticket</a>
                <a href="/personalProgram" class="btn btn-primary">View Personal Program</a>
            </div>
        <?php else: ?>
            <i class="fa-solid fa-circle-xmark"></i>
            <h1>Order Failed</h1>
            <p>Something went wrong with your payment. Please try again.</p>
            <div class="buttons">
                <a href="/checkout" class="btn btn-primary">Try Again</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html> 