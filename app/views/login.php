<?php
    $stylesheets = [
        'css/login.css',
    ];
    $title = 'Login - Haarlem Festival';
    include __DIR__ . '/header.php';
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h2>Login</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required
                        autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required
                        autocomplete="current-password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <p class="register">Don't have an account? <a href="/register">Register here</a></p>
            <a class="manage-account" href="/manageAccount">Manage your account</a>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
            
                <h2>Forgot Password</h2>

                <form method="post" action="/forgot-password">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
                
            </div>

        </div>

    </div>

</div>

<?php
    include __DIR__ . '/footer.php';
?>