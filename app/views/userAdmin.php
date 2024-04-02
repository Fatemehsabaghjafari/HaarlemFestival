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
        <form id="addArtistForm">
            <div class="form-group">
                <label for="artistName">Name:</label>
                <input type="text" class="form-control" id="artistName" name="artistName" required>
            </div>
            <div class="form-group">
                <label for="style">Style:</label>
                <input type="text" class="form-control" id="style" name="style" required>
            </div>
            <div class="form-group uploadImg">
                <label for="img">Upload Image:</label>
                <input type="file" class="form-control-file" id="img" name="img" accept="img/*" required>
            </div>
            <button type="submit" class="btn btn-primary addArtist">Add Artist</button>
        </form>

        <hr>
        <input type="text" id="searchInput" placeholder="Search...">
        <select id="sortBy">
            <option value="id">ID</option>
            <option value="username">Username</option>
            <option value="email">Email</option>
            <option value="roleId">Role ID</option>
        </select>
        <h2>All Users</h2>
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
                <!-- PHP loop for displaying existing artists -->
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
                        <td><?php echo $user->registrationDate; ?></td> <!-- Display registration date -->
                        <td>
                            <img class="djImg" src="<?php echo $user->img; ?>" alt="Image">
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm mr-2 delete-artist"
                                data-artist-id="<?php echo $artist['artistId']; ?>">Delete</button>
                            <button class="btn btn-primary btn-sm edit-artist"
                                data-artist-id="<?php echo $artist['artistId']; ?>"
                                data-artist-name="<?php echo $artist['artistName']; ?>"
                                data-artist-style="<?php echo $artist['style']; ?>"
                                data-artist-img="<?php echo $artist['img']; ?>">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="editArtistModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="editArtistForm">
                    <input type="hidden" id="editArtistId" name="editArtistId">
                    <label for="editArtistName">Name:</label>
                    <input type="text" id="editArtistName" name="editArtistName" required>
                    <label for="editArtistStyle">Style:</label>
                    <input type="text" id="editArtistStyle" name="editArtistStyle" required>
                    <label for="editArtistImage">Image:</label>
                    <input type="file" id="editArtistImage" name="editArtistImage">
                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="/javascript/admin.js"></script>
</body>

</html>
<script>
    // JavaScript for search/filter and sorting
    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#userTable tbody tr');
        
        rows.forEach(function(row) {
            let text = row.textContent.toLowerCase();
            if (text.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    document.getElementById('sortBy').addEventListener('change', function() {
        let sortBy = this.value;
        let rows = Array.from(document.querySelectorAll('#userTable tbody tr'));

        rows.sort(function(a, b) {
            let aValue = a.querySelector('td:nth-child(' + (['id', 'username', 'email', 'roleId'].indexOf(sortBy) + 1) + ')').textContent;
            let bValue = b.querySelector('td:nth-child(' + (['id', 'username', 'email', 'roleId'].indexOf(sortBy) + 1) + ')').textContent;
            return aValue.localeCompare(bValue);
        });

        let tbody = document.querySelector('#userTable tbody');
        tbody.innerHTML = '';
        rows.forEach(function(row) {
            tbody.appendChild(row);
        });
    });
</script>