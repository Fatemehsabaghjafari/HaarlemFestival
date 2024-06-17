<?php
    $stylesheets = [
        'css/login.css',
    ];
    $title = 'Password Reset';
    include __DIR__ . '/header.php';
?>
<main>
    <div class="centered-container reset-password-form">
        <h2>Reset Your Password</h2>

        <form method="post">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <label for="new_password">New Password:</label>

            <input type="password" id="new_password" name="new_password" required>
            <button type="submit" class="mt-2">Reset Password</button>
        </form>
    </div>
</main>

<?php
    include __DIR__ . '/footer.php';
?>