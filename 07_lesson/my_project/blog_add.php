<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/database/database_connection.php';
$connect = connect();

include_once __DIR__ . '/functions/functions.php';
include_once __DIR__ . '/functions/validator.php';
include_once __DIR__ . '/functions/database.php';


// todo to return to the page from which the request was made
if (!checkAuth($connect)) {
    exit;
}

$users = getAllUsers($connect);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hillel</title>
    <link rel="stylesheet" href="css/stylee.css">
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
                        <li class="nav-item">
                            <a class="nav-link"
                               href="controllers/exit.php">Exit</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<h1 class="form-title">Add new blog</h1>
<div class="container-fluid center width">
    <div class="row">
        <?php if (existsMessages('warnings')) { ?>
            <div class="alert alert-danger" role="alert">
                <?php
                foreach (getMessages('warnings') as $warning) {
                    echo "$warning <br>";
                }
                ?>
            </div>
        <?php } ?>
        <form action="controllers/blog_add.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title"
                       placeholder="Enter title" value="<?= getValue('blog_add_form', 'title') ?>">
            </div>
            <?php if ($errors = getValidationErrors('title')) { ?>
                <?php include './templates/_validation_errors.php'; ?>
            <?php } ?>
            <div class="mb-3">
                <label for="formFile" class="form-label">Insert file</label>
                <input type="file" class="form-control" name="image" id="formFile">
            </div>
            <div class="mb-3">
                <?php if ($users) { ?>
                    <select name="user_id" class="form-select">
                        <?php foreach ($users as $user) { ?>
                            <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Text</label>
                <textarea class="form-control" name="content" id="content"
                          rows="3"><?= getValue('blog_add_form', 'content') ?></textarea>
            </div>
            <?php if ($errors = getValidationErrors('content')) { ?>
                <?php include './templates/_validation_errors.php'; ?>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>
</html>