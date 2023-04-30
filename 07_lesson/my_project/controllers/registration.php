<?php
session_start();

require_once __DIR__ . '/../functions/functions.php';
require_once __DIR__ . '/../functions/database.php';
require_once __DIR__ . '/../functions/validator.php';
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../database/database_connection.php';

//1.Проверить метод HTTP;
//2.Валидация данных;
//3.Регистрация.
//4.Аутентификация.

//1.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setMessages('Method not allowed!', 'warnings');
    header('Location: ' . HOMEPAGE . ' ');
    exit;
}

//Set values from form into session
setValues('register_form', $_POST);

//2.
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

//збереження значення полів форми в сесію.
//setDataUserFromForm($_POST);


$errors = validate($_POST, [
    'name' => 'required|min_length[5]|',
    'email' => 'required|email|min_length[6]',
    'password' => 'required|min_length[5]|max_length[255]|password|confirm',
]);

if ($errors) {
    setValidationErrors($errors);
    header('Location: ' . HOMEPAGE . ' ');
    exit;
}


//3.Registration
//Check if user exist
if (checkUserExist($connect)) {
    $errors['email'][] = 'This email is already taken!';
    setValidationErrors($errors);
    header('Location: ' . HOMEPAGE . ' ');
    exit;
}

//Регистрируем пользователя и сохраняем данные в БД
$userData = [
    'name' => $name,
    'email' => $email,
    'password' => $passwordHash,
    'role_id' => 2,
];

registrationUser($connect, $userData);
setcookie('auth', true, time() + (3600 * 24 * 7), '/');
header('Location: http://localhost/homeworks/07_lesson/my_project/closed.php');







