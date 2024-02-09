<?php
require __DIR__ . '/../patternrouter.php';
require __DIR__ . '/../arrayrouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');
echo "hi";
$router = new PatternRouter();
$router->route($uri);

//$router = new arrayrouter();
//$router->route($uri);