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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dance.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <div>
        <?php
        include __DIR__ . '/header.php';
        ?>
        <img class="headPic" src="/img/dance.png" alt="Museum">

        <h1 class="danceHead">Harmony in Motion </h1>

        <p class="danceHeadP">Celebrating the Rhythm of Dance at Unleashed Beats Festival</p>

        <p class="danceHeadP">
            Get ready to groove to the hottest tunes spun by top DJs at our dance festival, a night of
            non-stop beats and unforgettable vibes!
        </p>

        <div class="top-djs">

            <div class="djHead">Our DJs</div>
            <div class="navigation-cards">
                <?php foreach ($danceArtists as $artist): ?>
                    <a href="/<?php echo $artist['artistName']; ?>">
                        <div class="navigation-card-container">
                            <div class="navigation-card-backdrop"></div>
                            <div class="navigation-card" style="background-image: url('<?php echo $artist['img']; ?>');">
                                <h3 class="dj">
                                    <?php echo $artist['artistName']; ?>
                                </h3>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <h1 class="danceHeadT">Tickets overview </h1>

    <?php
    include __DIR__ . '/danceSlideshow.php';
    ?>
    <div class="allAccessInfo1">
        All-Access pass for Friday €125,00, Saturday or Sunday €150,00

    </div>
    <div class="allAccessInfo2">

        All-Access pass for Friday, Saturday and Sunday €250,00

    </div>

    <h1 class="danceHeadT">Venues overview </h1>
    <?php
    include __DIR__ . '/danceVenue.php';
    ?>

    <h1 class="danceHeadT">Other festivals to enjoy </h1>
    <div class="navigation-cards">

        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/Jazz.png');">
                <h3>HAARLEM JAZZE</h3>
            </div>
        </div>
        <a href="/yummy">
            <div class="navigation-card-container">
                <div class="navigation-card-backdrop"></div>
                <div class="navigation-card" style="background-image: url('/img/Yummi!.png');">
                    <h3>YUMMI!</h3>
                </div>
            </div>
        </a>

        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/history_card.png');">
                <h3>A STROLL THROUGH HISTORY</h3>
            </div>
        </div>
    </div>

    <div class="kid">
        <img class="kidPic" src="img/kid.png" alt="Image">
    </div>

    <?php
    include __DIR__ . '/footer.php';
    ?>

    <div id="messageModal" class="modal" style="display: none;">
        <div class="modal-content custom-modal-width">
            <span class="close">&times;</span>
            <div class="modal-body">
                <h2>Message</h2>
                <p id="messageContent"></p>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-0K+0C9ROIdu0xOmIkJfQGSfSfpe8XNZ9MwTfXfM/6MTd0EEXtq2VPFZLVD80p8xX"
        crossorigin="anonymous"></script>
    <script src="/javascript/script.js"></script>
</body>

</html>

<script>
    $(document).ready(function () {
        $('.open-modal').click(function () {
            $('#myModal').modal('show');
            // You can pass data to the modal if needed using data attributes
            var ticketId = $(this).data('ticket-id');
            // Use ticketId in modal if necessary
        });

        // Close the modal when clicking on the close button
        $('#myModal .close').click(function () {
            $('#myModal').modal('hide');
        });

        // Handle button clicks
        $('.add-to-cart, .add-oneDay-to-cart, .add-allDays-to-cart').click(function () {
            var ticketId = $(this).data('ticket-id');
            var buttonText = $(this).text();
            // You can use ticketId and buttonText as needed
        });
    });

</script>