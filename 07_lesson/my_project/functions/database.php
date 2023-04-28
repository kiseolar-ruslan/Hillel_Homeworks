<?php

/**
 * Check user exist
 * @param PDO $connect
 * @return int
 */
function checkUserExist(PDO $connect): int
{
    $query = "SELECT count(`id`) FROM `users` WHERE `email` = :email";
//подготавливаем запрос
    $st = $connect->prepare($query);
//выполняем подготовленный запрос и по ключу 'email' передаем почту юзера в запрос
    $st->execute([
        'email' => $_POST['email'],
    ]);
//вытягиваем данные с БД
    return $st->fetchColumn();
}

/**
 * Registration user
 * @param PDO $connect
 * @param $data
 * @return void
 */
function registrationUser(PDO $connect, $data): void
{
    $queryDataUser = "INSERT INTO `users` (`name`, `email`,`password`, `role_id`) VALUES (:name, :email, :password, :role_id)";
    $stDataUser = $connect->prepare($queryDataUser);
    $stDataUser->execute($data);
}