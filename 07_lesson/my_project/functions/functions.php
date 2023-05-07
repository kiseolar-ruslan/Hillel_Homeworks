<?php
/**
 * Just for debug arrays
 * @param array $array
 * @return void
 */
function debug(array $array): void
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    exit;
}

/**
 * Set messages into SESSION
 * @param string|array $message
 * @param string $type
 * @return void
 */
function setMessages(string|array $message, string $type = 'alerts'): void
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION[$type][] = $message;
}

/**
 * Get messages from SESSION
 * @param string $type
 * @return array
 */
function getMessages(string $type): array
{
    $messages = $_SESSION[$type] ?? [];

    unset($_SESSION[$type]);

    return $messages;
}

/**
 * Check this if SESSION for this type exists
 * @param string $type
 * @return bool
 */
function existsMessages(string $type): bool
{
    return isset($_SESSION[$type]);
}

/**
 * Set values from form into session
 * @param array $values
 * @param string $type
 * @return void
 */
function setValues(string $type, array $values): void
{
    $_SESSION[$type] = $values;
}

/**
 * Get value form from session
 * @param string $type
 * @param string $key
 * @return string
 */
function getValue(string $type, string $key): string
{
    return $_SESSION[$type][$key] ?? '';
}

/**
 * Generate random token for user by id
 * @param int $id
 * @return string
 */
function generateToken(int $id): string
{
    $time = time();
    $randPart = rand(1000, 9999);
    return hash('sha256', $id . $randPart . $time);
}

/**
 * Get user IP
 * @return string
 */
function getUserIp(): string
{
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Get user agent(the system(browser) from which the user is sitting)
 * @return string
 */
function getUserAgent(): string
{
    return $_SERVER['HTTP_USER_AGENT'];
}

//todo do the same for the GET parameter

/**
 * Одно значение с post method будет: экранироваться, и весь html code превращаться в html entity
 * @param string $name
 * @param string $type
 * @return string
 */
function post(string $name, string $type = 'default'): string
{
    // экранирование
    $value = filter_input(INPUT_POST, $name, FILTER_SANITIZE_ADD_SLASHES);
    // html code превращаем в html entity
    $value = htmlspecialchars($value);

    switch ($type) {
        case 'email':
            $value = filter_var($value, FILTER_SANITIZE_EMAIL);
            break;
        case 'int':
            $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            break;
        case 'float':
            $value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT);
            break;
    }

    return $value;
}

/**
 * filter POST element
 * @param string $name
 * @return string
 */
function allPost(string $name): string
{
    // экранирование
    $value = filter_input(INPUT_POST, $name, FILTER_SANITIZE_ADD_SLASHES);
    // html code превращаем в html entity
    return htmlspecialchars($value);
}

/**
 * filtered all array POST
 * @param array $post
 * @return array
 */
function filterPost(array $post): array
{
    $filteredPost = [];
    foreach ($post as $key => $value) {
        $filteredPost[$key] = allPost($key);
    }

    return $filteredPost;
}

/**
 * @param string $data
 * @return string
 */
function reFilter(string $data): string
{
    return htmlspecialchars_decode($data);
}

/**
 * @param $file
 * @param $to
 * @return bool
 */
function moveFile($file, $to): bool
{
    if (!file_exists($to)) {
        mkdir($to);
    }

    if ($file['error']) {
        return false;
    }

    $fileName = $file['name'];
    $tmpName = $file['tmp_name'];

    return move_uploaded_file($tmpName, "$to/$fileName");
}