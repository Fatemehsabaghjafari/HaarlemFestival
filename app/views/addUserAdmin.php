<h2>Add New User</h2>
<!-- Form for adding new user -->
<form id="addUserForm" enctype="multipart/form-data">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
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