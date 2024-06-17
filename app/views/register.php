<?php
    $title = 'Register - Haarlem Festival';
    include __DIR__ . '/header.php';
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h2>Register</h2>
            <?php if (isset ($registrationError)): ?>
                <div class="alert alert-danger">
                    <?= $registrationError ?>
                </div>
            <?php endif; ?>
            <form method="post" action="http://localhost/register">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required required autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                </div>
                <div class="mb-3">
                    <div class="user-box">
                        <label for="password" class="form-label">Enter Captcha</label>
                        <input type="text" class="form-control" name="captcha" required>
                    </div>
                    <p class="mt-3">
                        <img src="/utils/captcha.php?rand=<?php echo rand(); ?>" id='captcha_image'>
                    </p>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <p class="text-danger mt-3">
                    <?php echo isset ($this->errorMsg) ? $this->errorMsg : '' ?>
                </p>
            </form>
            <p>Already have an account? <a href="/login">Login here</a></p>
        </div>
    </div>
</div>
<?php
    include __DIR__ . '/footer.php';
?>