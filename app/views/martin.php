<?php
$stylesheets = [
    'css/dance.css',
    'css/home.css',
];
$title = 'Martin Garrix - Dance!';
include __DIR__ . '/header.php';
?>

<div class="picAndOrange">
    <img class="img-fluid" src="/img/martinG.png" alt="Martin Garrix">
    <div class="orange">Martin Garrix</div>
</div>

<div class="container">
    <h1 class="nickyHead">Dance Experience with Martin Garrix! </h1>
    <p class="DanceHeadP"> Immerse yourself in Martin Garrix's dynamic beats and captivating melodies, where each
        track is a thrilling experience of energy and emotion. From the iconic "Animals" to soulful collaborations like
        "Don’t look down" his music is a vibrant journey that will ignite your passion for electronic beats.</p>
</div>
<div class="container-fluid">
    <h1 class="nickyTopHead">Top tracks of Martin</h1>
</div>

<div class="topSongContainer">
    <div class="eventH">Animals</div>
    <div class="content d-flex justify-content-between align-items-center">
        <img src="img/animal.png" alt="Image" class="img-fluid">
        <div class="audio-container">
            <h4>Click here to play the music</h4>
            <audio controls>
                <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
</div>

<div class="topSongContainer">
    <div class="eventH">Don't Look Down</div>
    <div class="content d-flex justify-content-between align-items-center">
        <img src="img/don'tLook.png" alt="Image" class="img-fluid">
        <div class="audio-container">
            <h4>Click here to play the music</h4>
            <audio controls>
                <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
</div>

<div class="container-fluid">
    <h1 class="nickyTopHead"> Martin’s schedule in festival</h1>
</div>
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
                <p class="eventDetail">Time: <?php echo date('H:i', strtotime($t['time'])); ?></p>
                <p class="eventDetail">Venue: <?php echo $t['venueName']; ?></p>
                <p class="eventDetail">Price: €<?php echo number_format($t['price'], 0, '.', ''); ?></p>
                <p class="eventDetail">All-Access pass for this day
                    €<?php echo number_format($t['oneDayAccessPrice'], 0, '.', ''); ?></p>
                <p class="eventDetail"><?php echo $t['session']; ?> session</p>
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

<div class="container-fluid">
    <h1 class="nickyTopHead"> Career Highlights</h1>
</div>
<div class="topSongContainer">
    <div class="content">
        <img class="highlightsImg img-fluid" src="img/martinHighlights.png" alt="Image">
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
    ['src' => '/javascript/script.js']
];

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