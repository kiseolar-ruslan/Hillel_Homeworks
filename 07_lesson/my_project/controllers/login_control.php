<?php
session_start();

require_once __DIR__ . '/../functions/functions.php';
require_once __DIR__ . '/../functions/database.php';
require_once __DIR__ . '/../functions/validator.php';
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../database/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setMessages('Method not allowed!', 'warnings');
    header('Location: http://localhost/homeworks/07_lesson/my_project/login_page.php');
}

//Set values from form into session
setValues('register_form', $_POST);

$errors = validate(filterPost($_POST), [
    'email' => 'required|email',
    'password' => 'required|password',
]);

if ($errors) {
    setValidationErrors($errors);
    header('Location: http://localhost/homeworks/07_lesson/my_project/login_page.php');
    exit;
}

//todo написать sql запрос, который будет вытягивать email, password с БД и сравнивать с введенным паролем и почтой.
// Возможно понадобятся функции с файла database.php.
