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
 * Check authentication
 * @return bool
 */
function checkAuth(): bool
{
    return $_COOKIE['auth'] ?? false;
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