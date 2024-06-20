<h2>Add New User</h2>
<!-- Form for adding new user -->
<form id="addUserForm" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required minlength="3" maxlength="20">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required minlength="8" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}">
        <small>Password must be 8-20 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character.</small>
    </div>

    <div class="form-group">
        <label for="role">Role:</label>
        <select class="form-control" id="role" name="role" required>
            <?php foreach ($roles as $role): ?>
                <option value="<?php echo $role['role']; ?>"><?php echo $role['role']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group uploadImg">
        <label for="img">Upload Image:</label>
        <input type="file" class="form-control-file" id="img" name="img" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-primary addArtist">Add User</button>
</form>

<script>
    function validateForm() {
        const img = document.getElementById('img').files[0];

        // Additional JavaScript validations if needed
        if (!img) {
            alert('Please upload an image.');
            return false;
        }

        const allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedImageTypes.includes(img.type)) {
            alert('Invalid image type. Allowed types are JPEG, PNG, GIF.');
            return false;
        }

        return true;
    }
</script>
