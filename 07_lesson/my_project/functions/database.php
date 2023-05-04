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
//вытягиваем результат запроса с БД
    return $st->fetchColumn();
}

/**
 * get user password
 * @param PDO $connect
 * @return string
 */
function getUserPassword(PDO $connect): string
{
    $query = "SELECT `password` FROM `users` WHERE `email` = :email";
    $st = $connect->prepare($query);
    $st->execute([
        'email' => $_POST['email'],
    ]);
    return $st->fetchColumn();
}

/**
 * Registration user
 * Try - Выполняется если ошибок нет
 * Catch - Выполняется если ошибки есть
 * try, catch - Отлавливание ошибок
 * используем при работе с исключениями, когда нужно отловить ошибки
 * Finally - Выполняется в любом случае
 * @param PDO $connect
 * @param $data
 * @return bool|int|string
 */
function registrationUser(PDO $connect, $data): bool|int|string
{
    try {
        $queryDataUser = "INSERT INTO `users` (`name`, `email`,`password`, `role_id`) VALUES (:name, :email, :password, :role_id)";
        $stDataUser = $connect->prepare($queryDataUser);
        $stDataUser->execute($data);
        return $connect->lastInsertId();
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Для создания токена при регистрации пользователя и проверки на регистрацию
 * @param PDO $connect
 * @param $data
 * @return int|bool
 */
function createSession(PDO $connect, $data): int|bool
{
    try {
        $queryDataUser = "INSERT INTO `users_sessions` (`user_id`, `token`,`user_agent`, `ip`) 
                                VALUES (:user_id, :token, :user_agent, :ip)";
        $stDataUser = $connect->prepare($queryDataUser);
        $stDataUser->execute($data);
        return $connect->lastInsertId();
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Check authentication
 * @param PDO $connect
 * @return bool
 */
function checkAuth(PDO $connect): bool
{
    $token = $_COOKIE['auth'] ?? false;
    if (!$token) {
        return false;
    }

    require_once __DIR__ . '/../database/database_connection.php';

    $session = getSession($connect, $token);
    if (!$session) {
        return false;
    }

    return true;
}

/**
 * get session info by auth token
 * Получение с БД записи сессии по токену, который хранится в cookie
 * @param PDO $connect
 * @param string $token
 * @return array|bool
 */
function getSession(PDO $connect, string $token): array|bool
{
    try {
        $queryDataUser = "SELECT * FROM `users_sessions` WHERE `token` = ? LIMIT 1";
        $stDataUser = $connect->prepare($queryDataUser);
        $stDataUser->execute([$token]);
        return $stDataUser->fetch();
    } catch (PDOException $e) {
        return false;
    }
}


function getUserByEmail(PDO $connect, string $email): array|bool
{
    try {
        $queryDataUser = "SELECT `id`, `email`, `password` FROM `users` WHERE `email` = ? LIMIT 1";
        $stDataUser = $connect->prepare($queryDataUser);
        $stDataUser->execute([$email]);
        return $stDataUser->fetch();
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * login user
 * @param PDO $connect
 * @param int $userId
 * @return void
 */
function login(PDO $connect, int $userId): void
{
    $token = generateToken($userId);
    $sessionData = [
        'user_id' => $userId,
        'token' => $token,
        'user_agent' => getUserAgent(),
        'ip' => getUserIp(),
    ];

    $sessionId = createSession($connect, $sessionData);
    if (!$sessionId) {
        setMessages('Data Base Error!', 'warnings');
        header('Location: ' . HOME_PAGE . 'login_page.php');
        exit;
    }

    setcookie('auth', $token, time() + (3600 * 24 * 7), '/');
}

