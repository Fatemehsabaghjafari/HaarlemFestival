<?php
    $stylesheets = [
        'css/home.css',
    ];
    $title = 'Haarlem Festival';
    include __DIR__ . '/header.php';
?>

<!-- <div class="welcome-banner">
    <div class="welcome-overlay">
        WELCOME TO HAARLEM
    </div>
</div> -->

<div class="banner-card">
    <div class="navigation-card-container navigation-card-container-big">
        <div class="navigation-card-backdrop navigation-card-backdrop-big"></div>
        <div class="navigation-card navigation-card-big" style="background-image: url('/img/festival_card.png');">
            <h3 class="festival-card-title">FESTIVAL <span class="new-line">25 - 28 JULY</span></h3>
        </div>
    </div>
</div>

<h2 class="title">EVENTS IN THE FESTIVAL</h2>
    
<div class="navigation-cards">
    <div class="navigation-card-container">
        <div class="navigation-card-backdrop"></div>
        <div class="navigation-card" style="background-image: url('/img/art_culture_card.png');">
            <h3>HAARLEM JAZZ</h3>
        </div>
    </div>

    <div class="navigation-card-container">
        <div class="navigation-card-backdrop"></div>
        <div class="navigation-card" style="background-image: url('/img/history_card.png');">
            <h3>YUMMY</h3>
        </div>
    </div>
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 </body>

    <div class="navigation-card-container">
        <div class="navigation-card-backdrop"></div>
        <div class="navigation-card" style="background-image: url('/img/foodies_card.png');">
            <h3>A STROLL THROUGH HISTORY</h3>
        </div>
    </div>

    <div class="navigation-card-container">
        <div class="navigation-card-backdrop"></div>
        <div class="navigation-card" style="background-image: url('/img/foodies_card.png');">
            <h3>DANCE!</h3>
        </div>
    </div>
    
    <div class="vertical-navigation-card-container">
        <div class="navigation-card-backdrop"></div>
        <div class="navigation-card" style="background-image: url('/img/kids-version.png');">
            <h3>
                KIDS
                <span>Teyler's Museum</span>
            </h3>
        </div>
    </div>
</div>

<?php
    include __DIR__ . '/footer.php';
?>