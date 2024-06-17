<?php
    $stylesheets = [
        'css/dance.css',
        'css/home.css',
    ];
    $title = 'Martin Garrix - Dance!';
    include __DIR__ . '/header.php';
?>

<img class="headPic" src="/img/martinG.png" alt="nicky">
<div class="orange">Martin Garrix</div>
<h1 class="nickyHead">Dance Experience with Martin Garrix! </h1>
<p class="artCultureHeadP"> Immerse yourself in Martin Garrix's dynamic beats and captivating melodies, where each
    track is a thrilling experience of energy and emotion. From the iconic "Animals" to soulful collaborations like
    "Don’t look down" his music is a vibrant journey that will ignite your passion for electronic beats.</p>
<h1 class="nickyTopHead">Top tracks of Martin</h1>

<div class="topSongContainer">
    <div class="eventH">Animals</div>
    <div class="content">
        <img src="img/animal.png" alt="Image">
    </div>
</div>

<div class="topSongContainer">
    <div class="eventH">Don't look down</div>
    <div class="content">
        <img src="img/don'tLook.png" alt="Image">
    </div>
</div>
<h1 class="nickyTopHead"> Martin’s schedule in festival</h1>
<div class="scheduleContainer">
    <?php foreach ($artistTickets as $t): ?>
        <div class="eventContainer">
            <div class="eventH">
                <?php
                $timestamp = strtotime($t['date']);
                $weekDay = date('l', $timestamp); // Full textual representation of the day of the week
                $month = date('F', $timestamp); // Full textual representation of the month
                $dayNumber = date('j', $timestamp); // Day of the month without leading zeros
                echo $weekDay . ', ' . $month . ' ' . $dayNumber;
                ?>
            </div>
            <div class="eventDetailContainer">
                <p class="eventDetail"> Time:
                    <?php echo date('H:i', strtotime($t['time'])); ?>
                </p>
                <p class="eventDetail"> Venue:
                    <?php echo $t['venueName']; ?>
                </p>
                <p class="eventDetail"> Price: €
                    <?php echo number_format($t['price'], 0, '.', ''); ?>
                </p> <!-- Format price without decimals -->
                <p class="eventDetail">All-Access pass for this day €
                    <?php echo number_format($t['oneDayAccessPrice'], 0, '.', ''); ?>
                </p> <!-- Format price without decimals -->
                <p class="eventDetail">
                    <?php echo $t['session']; ?> session
                </p>
                <a class="eventLocation"
                    href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($t['venueName']); ?>"
                    target="_blank">📍location</a>

            </div>
            <button class="btn btn-primary add-to-cart add-to-cartNicky" type="button"
                data-ticket-id="<?php echo $t['eventId']; ?>">Add to program</button>

        </div>
    <?php endforeach; ?>
    <div class="scheduleDP">
        <p class="scheduleP">All-Access pass for Friday, Saturday and Sun €250,00</p>
        <p class="scheduleP">Going for the deal? Select all tickets for the day, and an automatic discount will be
            applied.</p>
    </div>
</div>
<h1 class="nickyTopHead"> Career Highlights</h1>
<div class="topSongContainer">
    <div class="content">
        <img class="highlightsImg" src="img/martinHighlights.png" alt="Image">
        <p class="highlightsP">"Animals" Breakthrough (2013): Garrix rose to fame with the iconic track "Animals,"
            solidifying his position as a leading force in electronic music.

            Global Chart Success: Continual chart-topping hits showcased Garrix's enduring influence in the
            electronic music scene.

            A-List Collaborations: Collaborations with Usher, Dua Lipa, and Khalid expanded his musical reach,
            contributing to the crossover success of electronic music.
        </p>
    </div>
</div>
<?php
    $scripts = [
        ['src' => '/javascript/script.js' ]
    ];

    include __DIR__ . '/footer.php';
?>