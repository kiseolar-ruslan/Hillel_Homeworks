<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['alerts'] = 'Method not allowed!';
    header('Location: http://localhost/homeworks/07_lesson/my_project/');

}

