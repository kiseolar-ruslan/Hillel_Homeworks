<?php

include_once __DIR__ . '/../config.php';

/**
 * DataBase connection
 * Try - Выполняется если ошибки нет
 * Catch - Выполняется если ошибка есть
 * Finally - Выполняется в любом случае
 */
try {
    $connect = new PDO('mysql:host=localhost;dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
} catch (PDOException $e) {
    echo $e->getMessage();
}

