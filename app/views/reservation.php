<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Restaurant Reservation Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Restaurant Reservation</h2>
    <form method="post" action="http://localhost/yummy">
        <div class="mb-3">
            <label for="adults" class="form-label">Number of Adults:</label>
            <select class="form-select" id="adults" name="adults" required>
                <option selected disabled>Select</option>
                <?php for($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kids" class="form-label">Number of Kids:</label>
            <select class="form-select" id="kids" name="kids" required>
                <option selected disabled>Select</option>
                <?php for($i = 0; $i <= 5; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date:</label>
            <select class="form-select" id="time" name="time" required>
                <option selected disabled>Select</option>
                <option value="09:00 AM">09:00 AM</option>
                <option value="12:00 PM">12:00 PM</option>
                <option value="03:00 PM">03:00 PM</option>
                <option value="06:00 PM">06:00 PM</option>
                <!-- Add more options as needed -->
            </select>        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Time:</label>
            <select class="form-select" id="time" name="time" required>
                <?php foreach ($timeslots as $timeslot): ?>
                    <option value="<?php echo $timeslot ?>"><?php echo $timeslot ?></option>
                <?php endforeach; ?>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Message:</label>
            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Submit Reservation</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission
        if(isset($_POST["submit"])){
            // Your code to handle form submission, for example:
            // Call the AddReservation method with appropriate parameters
            // $repository->AddReservation($userId, $restaurantId, $_POST['adults'], $_POST['kids'], $_POST['date'], $_POST['time'], $_POST['message']);
        }
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-JsKRQVTSAYYsIS/iUMC0Zz7l76Mz5RpOUVRlu4NfG5jrg3tfsSuxU0UXUbp0DRQI" crossorigin="anonymous"></script>
</body>
</html>
