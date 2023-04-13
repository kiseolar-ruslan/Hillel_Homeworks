<?php
session_start();

require_once __DIR__ . '/../functions/functions.php';
require_once __DIR__ . '/../functions/validator.php';

//1.Проверить метод HTTP;
//2.Валидация данных;
//3.Регистрация.
//4.Аутентификация.

//1.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setMessages('Method not allowed!', 'warnings');
    header('Location: http://localhost/homeworks/07_lesson/my_project/');
}

//2.
$name = $_POST['name'];

$errors = validate($_POST, [
    'name' => 'required|min_length[5]|max_length[255]',
    'email' => 'required|email|min_length[6]',
    'password' => 'required|min_length[5]|max_length[255]|password',
    'password_confirm' => 'required|password_confirm'
]);

if ($errors) {
    setMessages($errors);
    header('Location: http://localhost/homeworks/07_lesson/my_project/');
}

//debug($_POST);

//3.Registration
//todo need connect to DB

//$_SESSION['auth'] = true;

setcookie('auth', true, time() + (3600 * 24 * 7), '/' );

