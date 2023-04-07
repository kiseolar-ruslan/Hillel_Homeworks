<?php
//Debugger
function debugger(array $array): void
{
    echo "<pre>";
    print_r($array);
    echo "<pre>";
    exit;
}

//Set Alerts
function setAlerts(string $value, string $message): void
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['alerts'])) {
        $_SESSION['alerts'] = [];
    }

    if (isset($_SESSION['alerts'])) {
        $_SESSION['alerts'][$value] = $message;
    }
}

//Return Session
function returnSession(string $nameValue): void
{
    if (isset($_SESSION['alerts'][$nameValue])) {
        print_r($_SESSION['alerts'][$nameValue]);
        unset($_SESSION['alerts'][$nameValue]);
    }
}
