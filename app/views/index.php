<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Haarlem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/home.css">
</head>

<body>

    <?php
    include __DIR__ . '/header.php';
    ?>

    <div class="welcome-banner">
        <div class="welcome-overlay">
            WELCOME TO HAARLEM
        </div>
    </div>

    <h2 class="title">DISCOVER HAARLEM</h2>
      
    <div class="navigation-cards">
        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/art_culture_card.png');">
                <h3>ART & CULTURE</h3>
            </div>
        </div>

        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/history_card.png');">
                <h3>HISTORY</h3>
            </div>
        </div>

        <div class="navigation-card-container">
            <div class="navigation-card-backdrop"></div>
            <div class="navigation-card" style="background-image: url('/img/foodies_card.png');">
                <h3>HAARLEM FOR FOODIES</h3>
            </div>
        </div>

        <div class="navigation-card-container navigation-card-container-big">
            <div class="navigation-card-backdrop navigation-card-backdrop-big"></div>
            <div class="navigation-card navigation-card-big" style="background-image: url('/img/festival_card.png');">
                <h3 class="festival-card-title">FESTIVAL <span class="new-line">25 - 28 JULY</span></h3>
            </div>
        </div>
    </div>
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 </body>

</html>

