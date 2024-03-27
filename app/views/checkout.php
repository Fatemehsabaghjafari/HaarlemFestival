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
        include '../components/CheckoutItem.php';
    ?>

    <script>
        const personalProgram = <?php echo json_encode($personalProgram); ?>;
    </script>
    
    <div class="checkout-container">
        <div class="order-items list-view">
            <?php foreach ($personalProgram as $date => $events): ?>
                <div class="days">
                    <div class="date"><?php echo date('d F l', strtotime($date)); ?></div>
                    <?php if (empty($events)): ?>
                        <div class="no-event">
                            <div>You don’t have any events booked on <?php echo date('d F l', strtotime($date)); ?></div>
                            <a href="">View Festival Overview</a>
                        </div>
                    <?php else: ?>
                        <?php $checkoutItem = new CheckoutItem() ?>
                        <?php foreach ($events as $event): ?>
                            <?php
                                $data = $event;
                                $html = $checkoutItem->render($date, $data);
                                echo $html;
                            ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="checkout-form">
            <h2>Personal Information</h2>
            <div class="personal-info-row">
                <div>
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname">
                </div>
                <div>
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname">
                </div>
            </div>
            <div class="personal-info-row">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email">
                </div>
                <div>
                    <label for="tel">Phone</label>
                    <input type="tel" id="tel" placeholder="+31 6 12 34 56 78">
                </div>
            </div>
            
            
        </div>
    </div>

    <script src="/javascript/personalProgram.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>