<?php
session_start();

require_once __DIR__ . '/../functions/functions.php';
require_once __DIR__ . '/../functions/validator.php';
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../database/database.php';

//1.Проверить метод HTTP;
//2.Валидация данных;
//3.Регистрация.
//4.Аутентификация.

//1.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setMessages('Method not allowed!', 'warnings');
    header('Location: ' . HOMEPAGE . ' ');
}

//2.
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);


$errors = validate($_POST, [
    'name' => 'required|min_length[5]|',
    'email' => 'required|email|min_length[6]',
    'password' => 'required|min_length[5]|max_length[255]|password',
    'password_confirm' => 'required|password_confirm'
]);

if ($errors) {
    setMessages($errors);
    header('Location: ' . HOMEPAGE . ' ');
}


//3.Registration

$query = "SELECT count(*) FROM `users` WHERE `email` = :email";

//подготавливаем запрос
$st = $connect->prepare($query);

//выполняем подготовленный запрос и по ключу 'email' передаем почту юзера в запрос
$st->execute([
    'email' => $email,
]);

//вытягиваем данные с БД
$user = $st->fetchColumn();

//Проверяем на существование юзера по email
if ($user) {
    setMessages('This email is already taken!', 'warnings');
    header('Location: ' . HOMEPAGE . ' ');
}

//Регистрируем пользователя и сохраняем данные в БД
$queryDataUser = "INSERT INTO `users` (`email`,`name`,`password`) VALUES (:email, :name, :password)";

$stDataUser = $connect->prepare($queryDataUser);

if (empty($errors)) {
    $stDataUser->execute([
        'email' => $email,
        'name' => $name,
        'password' => $passwordHash
    ]);
    setcookie('auth', true, time() + (3600 * 24 * 7), '/');
    header('Location: http://localhost/homeworks/07_lesson/my_project/closed.php');
}


