<?php
    $stylesheets = [
        'css/dance.css',
        'css/home.css',
    ];
    $title = 'Dance Festival';
    include __DIR__ . '/header.php';
?>
<div>
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

<div id="messageModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-body">
            <h2>Message</h2>
            <p id="messageContent"></p>
        </div>
    </div>
</div>

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

<?php
    $scripts = [
        ['src' => '/javascript/script.js' ]
    ];

    include __DIR__ . '/footer.php';
?>