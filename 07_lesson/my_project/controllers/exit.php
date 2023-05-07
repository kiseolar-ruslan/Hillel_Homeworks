<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../database/database_connection.php';
$connect = connect();
require_once __DIR__ . '/../functions/database.php';

if (checkAuth($connect)) {
    require_once __DIR__ . '/../config.php';
    try {
        $sql = 'DELETE FROM `users_sessions` WHERE `token` = ?';
        $stmt = $connect->prepare($sql);
        $stmt->execute([$_COOKIE['auth']]);
    } catch (PDOException $exception) {
        echo $exception->getMessage();
    }

    setcookie('auth', $_COOKIE['auth'], time() - 3600, '/');

    header('Location: ' . HOME_PAGE);
}