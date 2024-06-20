<div id="editUserModal" class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <form id="editUserForm" onsubmit="return validateEditForm()">
        <input type="hidden" id="editUserId" name="editUserId">
        <div class="modal-body">
            <div class="form-group">
                <label for="editEmail">Email:</label>
                <input type="email" class="form-control" id="editEmail" name="editEmail" required>
            </div>
            <div class="form-group">
                <label for="editUsername">Username:</label>
                <input type="text" class="form-control" id="editUsername" name="editUsername" required minlength="3" maxlength="20">
            </div>
            <div class="form-group">
                <label for="editRole">Role:</label>
                <select class="form-control" id="editRole" name="editRole" required>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role['role']; ?>"><?php echo $role['role']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="editUserImage">Upload Image:</label>
                <input type="file" class="form-control-file" id="editUserImage" name="editUserImage" accept="image/*">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>

<script>
    function validateEditForm() {
        const img = document.getElementById('editUserImage').files[0];

        if (img) {
            const allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!allowedImageTypes.includes(img.type)) {
                alert('Invalid image type. Allowed types are JPEG, PNG, GIF.');
                return false;
            }
        }

        return true;
    }
</script>
