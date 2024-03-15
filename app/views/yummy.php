

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yummi!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/yummy_style.css">
  <link href="css/style.css" rel="stylesheet">

  <style>
.container .card:nth-child(odd) .bg-cream {
      max-width: 1807px;
      background: rgba(224, 203, 160, 0.50) !important;
    }

    .container .card:nth-child(even) .bg-cream {
      max-width: 1807px;
      background: rgba(224, 203, 160, 0.50) !important;
    }

    .container .card:nth-child(odd) .bg-gray {
      border-radius: 15px;
      background: linear-gradient(0deg, rgba(0, 0, 0, 0.20) 0%, rgba(0, 0, 0, 0.20) 100%), #FFF;
    }

    .container .card:nth-child(even) .bg-gray {
      border-radius: 15px;
      background: linear-gradient(0deg, rgba(0, 0, 0, 0.20) 0%, rgba(0, 0, 0, 0.20) 100%), #FFF;
    }
</style>
</head>
<body>

  <?php
  include __DIR__ . '/header.php';
  ?>

  <div class="container">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/img/Food Festeval-1.png" class="d-block w-100" alt="Food Festeval-1">
        </div>
        <div class="carousel-item">
          <img src="/img/Food Festeval-2.png" class="d-block w-100" alt="Food Festeval-2">
        </div>
        <div class="carousel-item">
          <img src="/img/Food Festeval-3.png" class="d-block w-100" alt="Food Festeval-2">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <h1> Haarlem Food Festival Culinary 2024</h1>

  <div class="container background">
    <p class="text">Join us at the culinary extravaganza in Haarlem! From July 27 to July 31, 2024, immerse yourself in the festivities at Grote Markt. 
      Don't miss out on diverse tastings, live bands, and the vibrant atmosphere. 
      Bring your friends and make it an unforgettable experience!"</p>
  </div>

  <h1>Restaurants</h1>

  <div class="container">
  <?php foreach ($RestaurantsItems as $restaurant): ?>
    <div class="card bg-cream mb-3">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="<?php echo $restaurant->img; ?>" class="img-fluid rounded-start" alt="<?php echo $restaurant->name; ?>">
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <h5 class="card-title"><?php echo $restaurant->name; ?></h5>
            <?php echo $restaurant->description; ?>
            <p class="card-text">Festival Opening hours: <?php echo $restaurant->firstSession; ?></p>
            <p class="card-text">Price Range: per person: <?php echo $restaurant->adultPrice; ?>, Kids: <?php echo $restaurant->kidPrice; ?></p>
          </div>
          <button>Map</button>
          <button><a href="/yummy">Discover More..</a></button>
          <button>Book Table</button>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

    <?php
    include __DIR__ . '/footer.php';
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>