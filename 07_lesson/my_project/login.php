<?php
session_start();

require_once __DIR__ . '/functions/functions.php';
include_once __DIR__ . '/functions/validator.php';
include_once __DIR__ . '/database/database_connection.php';

if (!checkAuth()) {
    setMessages('Page for authorized users!', 'warnings');
    header('Location: ' . HOMEPAGE . ' ');
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hillel</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
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
        <h1 class="form-title">Sign In</h1>
        <form action="controllers/login_control.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We will never give your email to anyone.</div>
            </div>
            <?php if ($errors = getValidationErrors('email')) { ?>
                <?php include './templates/_validation_errors.php'; ?>
            <?php } ?>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <?php if ($errors = getValidationErrors('password')) { ?>
                <?php include './templates/_validation_errors.php'; ?>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>
</html>
