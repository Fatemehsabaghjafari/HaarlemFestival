<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Haarlem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="css/dance.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>

    <?php
    include __DIR__ . '/adminHeader.php';
    ?>

    <div class="container mt-5">
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
                <label for="roleId">Role ID:</label>
                <input type="number" class="form-control" id="roleId" name="roleId" required>
            </div>
            <div class="form-group uploadImg">
                <label for="img">Upload Image:</label>
                <input type="file" class="form-control-file" id="img" name="img" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary addArtist">Add User</button>
        </form>

        <hr>
        <h2>All Users</h2>
        <input type="text" id="searchInput" placeholder="Search...">
        <select id="sortBy">
            <option value="id">ID</option>
            <option value="username">Username</option>
            <option value="email">Email</option>
            <option value="roleId">Role ID</option>
        </select>

        <table class="table table-striped" id="userTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>RoleId</th>
                    <th>Registration Date</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP loop for displaying existing users -->
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?php echo $user->id; ?>
                        </td>
                        <td>
                            <?php echo $user->username; ?>
                        </td>
                        <td>
                            <?php echo $user->email; ?>
                        </td>
                        <td>
                            <?php echo $user->roleId; ?>
                        </td>
                        <td>
                            <?php echo $user->registrationDate; ?>
                        </td> 
                        <td>
                            <img class="djImg" src="<?php echo $user->img; ?>" alt="Image">
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm mr-2 delete-user"
                                data-user-id="<?php echo $user->id; ?>">Delete</button>

                            <button class="btn btn-primary btn-sm edit-user" data-user-id="<?php echo $user->id; ?>"
                                data-user-email="<?php echo $user->email; ?>"
                                data-user-username="<?php echo $user->username; ?>"
                                data-user-roleid="<?php echo $user->roleId; ?>"
                                data-user-img="<?php echo $user->img; ?>">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="editUserModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="editUserForm">
                    <input type="hidden" id="editUserId" name="editUserId">
                    <label for="editEmail">Email:</label>
                    <input type="email" id="editEmail" name="editEmail" required>
                    <label for="editUsername">Username:</label>
                    <input type="text" id="editUsername" name="editUsername" required>
                    <label for="editRoleId">Role ID:</label>
                    <input type="number" id="editRoleId" name="editRoleId" required>
                    <div class="form-group uploadImg">
                        <label for="editUserImage">Upload Image:</label>
                        <input type="file" class="form-control-file" id="editUserImage" name="editUserImage"
                            accept="image/*">
                    </div>

                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="/javascript/userAdmin.js"></script>
</body>

</html>
<script>
    // JavaScript for search/filter and sorting
    document.getElementById('searchInput').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#userTable tbody tr');

        rows.forEach(function (row) {
            let text = row.textContent.toLowerCase();
            if (text.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    document.getElementById('sortBy').addEventListener('change', function () {
        let sortBy = this.value;
        let rows = Array.from(document.querySelectorAll('#userTable tbody tr'));

        rows.sort(function (a, b) {
            let aValue = a.querySelector('td:nth-child(' + (['id', 'username', 'email', 'roleId'].indexOf(sortBy) + 1) + ')').textContent;
            let bValue = b.querySelector('td:nth-child(' + (['id', 'username', 'email', 'roleId'].indexOf(sortBy) + 1) + ')').textContent;
            return aValue.localeCompare(bValue);
        });

        let tbody = document.querySelector('#userTable tbody');
        tbody.innerHTML = '';
        rows.forEach(function (row) {
            tbody.appendChild(row);
        });
    });
</script>