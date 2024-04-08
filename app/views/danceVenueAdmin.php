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
    <link rel="stylesheet" href="css/admin.css">

</head>

<body>

    <?php
    include __DIR__ . '/adminHeader.php';
    ?>
    <div class="container mt-5">
        <h2>Add New Venue</h2>
        <!-- Form for adding new venue -->
        <form id="addVenueForm">
            <div class="form-group venue">
                <label for="venueName">Name:</label>
                <input type="text" class="form-control" id="venueName" name="venueName" required>
            </div>
            <div class="form-group">
                <label for="venueAddress">Address:</label>
                <input type="text" class="form-control" id="venueAddress" name="venueAddress" required>
            </div>

            <button type="submit" class="btn btn-primary addArtist">Add Venue</button>
        </form>

        <hr>
        <h2>All Venues</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP loop for displaying existing artists -->
                <?php foreach ($danceVenues as $venue): ?>
                    <tr>
                        <td>
                            <?php echo $venue['venueId']; ?>
                        </td>
                        <td>
                            <?php echo $venue['venueName']; ?>
                        </td>
                        <td>
                            <?php echo $venue['venueAddress']; ?>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm mr-2 delete-venue"
                                data-venue-id="<?php echo $venue['venueId']; ?>">Delete
                            </button>

                            <button class="btn btn-primary btn-sm edit-venue"
                                data-venue-id="<?php echo $venue['venueId']; ?>"
                                data-venue-name="<?php echo $venue['venueName']; ?>"
                                data-venue-address="<?php echo $venue['venueAddress']; ?>">Edit
                            </button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="editVenueModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="editVenueForm">
                    <input type="hidden" id="editVenueId" name="editVenueId">
                    <label for="editVenueName">Name:</label>
                    <input type="text" id="editVenueName" name="editVenueName" required>
                    <label for="editVenueAddress">Address:</label>
                    <input type="text" id="editVenueAddress" name="editVenueAddress" required>
                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="/javascript/adminDanceVenue.js"></script>
</body>

</html>