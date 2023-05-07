<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../functions/functions.php';
require_once __DIR__ . '/../functions/database.php';
require_once __DIR__ . '/../functions/validator.php';
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../database/database_connection.php';
$connect = connect();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setMessages('Method not allowed!', 'warnings');
    header('Location: ' . HOME_PAGE . 'login_page.php');
}

//Set values from form into session
setValues('login_form', $_POST);

// Filtered POST method
$filteredPost = filterPost($_POST);

//Validation
$errors = validate($filteredPost, [
    'email' => 'required|email|min_length[6]',
    'password' => 'required|password',
]);

if ($errors) {
    setValidationErrors($errors);
    header('Location: ' . HOME_PAGE . 'login_page.php');
    exit;
}

$dbUser = getUserByEmail($connect, post('email', 'email'));

if (!$dbUser) {
    $errors['email'][] = 'Email or password is invalid!';
    setValidationErrors($errors);
    header('Location: ' . HOME_PAGE . 'login_page.php');
    exit;
}

if (password_verify($filteredPost['password'], $dbUser['password'])) {
    login($connect, $dbUser['id']);
    header('Location: ' . HOME_PAGE . 'closed_page.php');
} else {
    $errors['email'][] = 'Email or password is invalid!';
    setValidationErrors($errors);
    header('Location: ' . HOME_PAGE . 'login_page.php');
}







