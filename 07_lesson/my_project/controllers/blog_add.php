<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../functions/blog.php';
require_once __DIR__ . '/../functions/functions.php';
require_once __DIR__ . '/../functions/database.php';
require_once __DIR__ . '/../functions/validator.php';
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../database/database_connection.php';
$connect = connect();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setMessages('Method not allowed!', 'warnings');
    header('Location: ' . HOME_PAGE . 'blog_add.php');
}

//Set values from form into session
setValues('blog_add_form', $_POST);

// Filtered POST method
$filteredPost = filterPost($_POST);

//Validation
$errors = validate($filteredPost, [
    'title' => 'required|min_length[6]|max_length[255]',
    'content' => 'required|min_length[6]|max_length[20000]',
    'user_id' => 'required',
//    'image' => 'required',
]);

if ($errors) {
    setValidationErrors($errors);
    header('Location: ' . HOME_PAGE . 'blog_add.php');
    exit;
}

if (moveFile($_FILES['image'], '../storage/blogs')) {
    $data = [
        'user_id' => post('user_id', 'int'),
        'title' => post('title'),
        'image' => 'storage/blogs/' . $_FILES['image']['name'],
        'content' => post('content'),
    ];

    if (blogAdd($connect, $data)) {
        header('Location: ' . HOME_PAGE . 'closed_page.php');
    } else {
        setMessages('Data Base error!', 'warnings');
        header('Location: ' . HOME_PAGE . 'blog_add.php');
    }
} else {
    setMessages('File error!', 'warnings');
    header('Location: ' . HOME_PAGE . 'blog_add.php');
}