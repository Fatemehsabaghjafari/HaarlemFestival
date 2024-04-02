<?php
$email = $_POST['email'];
$token = bin2hex(random_bytes(16));
$tokenHash = hash("sha256", $token);

$expiry = date("Y-m-d H-m-s", time() + 60 * 30);

$mysqli = require __DIR__ . '/../config/dbconfig.php';
$sql = "UPDATE users SET token_hash = ?, expiry_token = ? WHERE email = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sss", $email, $tokenHash, $expiry);
$stmt->execute();

