<?php
session_start();

require_once __DIR__ . '/../functions/functions.php';
require_once __DIR__ . '/../functions/database.php';
require_once __DIR__ . '/../functions/validator.php';
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../database/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setMessages('Method not allowed!', 'warnings');
    header('Location: http://localhost/homeworks/07_lesson/my_project/login.php');
}

$email = $_POST['email'];
$password = $_POST['password'];
$passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

$errors = validate($_POST, [
    'email' => 'required|email|min_length[6]',
    'password' => 'required|min_length[5]|max_length[255]|password',
]);

if ($errors) {
    setValidationErrors($errors);
    header('Location: http://localhost/homeworks/07_lesson/my_project/login.php');
}

if (checkUserExist($connect)) {
    $errors['email'][] = 'This email is already taken!';
    setValidationErrors($errors);
    header('Location: http://localhost/homeworks/07_lesson/my_project/login.php');
}

