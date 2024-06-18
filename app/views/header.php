<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="/css/style.css">

    <!-- Dynamic CSS -->
    <?php
    if (isset($stylesheets) && is_array($stylesheets)) {
      foreach ($stylesheets as $stylesheet) {
        echo '<link href="' . $stylesheet . '" rel="stylesheet">';
      }
    }
    ?>

  <title><?php $title ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="img/Logo.png" alt="Logo" class="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Festival
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <ul>
              <li><a class="dropdown-item" href="#">Festival Overview</a></li>
              <li><a class="dropdown-item" href="#">Festival Agenda</a></li>
            </ul>
            <ul>
              <li><a class="dropdown-item" href="#">HAARLEM JAZZ</a></li>
              <li><a class="dropdown-item" href="/yummy">YUMMY!</a></li>
              <li><a class="dropdown-item" href="#">A STROLL THROUGH HISTORY</a></li>
              <li><a class="dropdown-item" href="/dance">DANCE!</a></li>
            </ul>
          </div>
        </li>
          <li class="nav-item">
            <a class="nav-link active" href="/personalProgram">Personal Program</a>
          </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item logo_language">
          <a class="nav-link" href="/login" role="button">
            <img src="/img/user-icon.png" alt="user icon" class="logo_language_img">
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>