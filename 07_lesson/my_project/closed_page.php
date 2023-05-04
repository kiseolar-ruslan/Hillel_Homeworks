<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/database/database_connection.php';
require_once __DIR__ . '/functions/functions.php';
include_once __DIR__ . '/config.php';
include_once __DIR__ . '/functions/database.php';

if (!checkAuth($connect)) {
    setMessages('Page for authorized users!', 'warnings');
    header('Location: ' . HOME_PAGE);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hillel</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<div class="row">
    <nav class="navbar navbar-expand-lg bg-body-tertiary padding">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if (!checkAuth($connect)) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/homeworks/07_lesson/my_project/">Registration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="http://localhost/homeworks/07_lesson/my_project/login_page.php">Login</a>
                        </li>
                    <?php } ?>
                    <?php if (checkAuth($connect)) { ?>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="http://localhost/homeworks/07_lesson/my_project/closed_page.php">Blogs</a>
                        </li>
                        <!--При выходе должно перебрасывать на вводную страницу где написано
                        "Добро пожаловать на наш сайт-->
                        <form method="">
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="controllers/exit.php">Exit</a>
                            </li>
                        </form>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>
</html>
