<?php
    $stylesheets = [
        'css/personalProgram.css',
        'css/checkout.css',
    ];
    $title = 'Order Confirmation';
    include __DIR__ . '/header.php';
?>

<div class="order-confirmation-container">
    <?php if ($isOrderCompleted): ?>
        <i class="fa-solid fa-circle-check"></i>
        <h1>Order Confirmation</h1>
        <p>The ticket and invoice has been sent to your email address</p>
        <div class="buttons">
            <!-- <a href="/personalProgram" class="btn btn-primary">Download Ticket</a> -->
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

<?php
    include __DIR__ . '/footer.php';
?>