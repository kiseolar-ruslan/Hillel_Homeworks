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

    $message = $_SESSION[$type] ?? [];

    unset($_SESSION[$type]);

    return $message;
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
 * Check authentication
 * @return bool
 */
function checkAuth(): bool
{
    return $_COOKIE['auth'] ?? false;
}
