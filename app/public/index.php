<?php
// require __DIR__ . '/../patternrouter.php';
require __DIR__ . '/../arrayrouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

// $router = new PatternRouter();
// $router->route($uri);
$router = new arrayrouter();
$uriParts = explode('?', $uri);
$path = $uriParts[0];
$router->route($path);