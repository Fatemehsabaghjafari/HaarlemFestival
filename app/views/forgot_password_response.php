<?php
    $stylesheets = [
        'css/personalProgram.css',
        'css/checkout.css',
    ];
    $title = 'Password Reset';
    include __DIR__ . '/header.php';
?>
<main>
    <div class="order-confirmation-container mt-5 mb-5">
        <?php if ($responseMessage["success"]): ?>
            <i class="fa-solid fa-circle-check"></i>
            <h1>Reset Password</h1>
            <p><?php echo $responseMessage['message']; ?></p>
            <div class="buttons">
                <!-- <a href="/personalProgram" class="btn btn-primary">Download Ticket</a> -->
                <a href="/login" class="btn btn-primary">Login</a>
            </div>
        <?php else: ?>
            <i class="fa-solid fa-circle-xmark"></i>
            <h1>Reset Password</h1>
            <p><?php echo $responseMessage['message']; ?></p>
            <div class="buttons">
                <a href="/login" class="btn btn-primary">Go back</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
    include __DIR__ . '/footer.php';
?>