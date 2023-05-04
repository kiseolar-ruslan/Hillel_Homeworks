<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../config.php';


$sql = 'DELETE FROM `users_sessions` WHERE `token` = ?';
$stmt = $connect->prepare($sql);
$stmt->execute([$_COOKIE['auth']]);

setcookie('auth', $_COOKIE['auth'], time() -3600, '/');

header('Location: ' . HOME_PAGE);