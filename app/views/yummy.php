<?php
    $stylesheets = [
        'css/yummy_style.css',
    ];
    $title = 'Yummy - Haarlem Festival';
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
    <p class="text">Join us at the culinary extravaganza in Haarlem! From July 27 to July 31, 2024, immerse yourself in
        the festivities at Grote Markt.
        Don't miss out on diverse tastings, live bands, and the vibrant atmosphere.
        Bring your friends and make it an unforgettable experience!"</p>
</div>

<h1>Restaurants</h1>

<div class="container">
    <?php foreach ($RestaurantsItems as $restaurant): ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $restaurant->img; ?>" class="img-fluid rounded-start" alt="<?php echo $restaurant->name; ?>">
                    <i class="fa-sharp fa-solid fa-star" style="color: #FFD43B;"></i>
                    <i class="fa-sharp fa-solid fa-star" style="color: #FFD43B;"></i>
                    <i class="fa-sharp fa-solid fa-star" style="color: #FFD43B;"></i>
                    <i class="fa-sharp fa-solid fa-star" style="color: #FFD43B;"></i>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $restaurant->name; ?>
                        </h5>
                        <?php echo $restaurant->description; ?>
                        <p class="card-text">Festival Opening hours:
                            <?php echo date('H:i', strtotime($restaurant->firstSession)); ?>
                        </p>
                        <p class="card-text">Price Range: per person:
                            <?php echo $restaurant->adultPrice; ?>, Kids:
                            <?php echo $restaurant->kidPrice; ?>
                        </p>
                        <button class="btn btn-secondary">Map</button>
                        <button class="btn btn-secondary"><a href="<?php echo $restaurant->pageLink; ?>" class="link">Discover More..</a></button>
                        <button class="btn btn-secondary">Book Table</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
    include __DIR__ . '/footer.php';
?>