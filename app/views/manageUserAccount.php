<!DOCTYPE html>
<html lang="en">

<head>
    <title>Haarlem Festival</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <form action="edit_email.php" method="post" class="mb-3">
            <div class="mb-3">
                <label for="email" class="form-label">New Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Email</button>
        </form>

        <form action="edit_name.php" method="post" class="mb-3">
            <div class="mb-3">
                <label for="name" class="form-label">New Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Name</button>
        </form>

        <form action="change_password.php" method="post" class="mb-3">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password:</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>

        <form action="upload_picture.php" method="post" enctype="multipart/form-data" class="mb-3">
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Upload Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload Picture</button>
        </form>
    </div>
</body>

</html>
