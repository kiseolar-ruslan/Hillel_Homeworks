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
if (checkAuth($connect)) {
    exit;
}

//$errors['email'][] = 'This email is already taken2!';
//$errors['email'][] = 'This email is already taken3!';
//
//debug($errors);

//$users = [
//    [
//        'email' => 'email1@gmail.com',
//        'name' => 'name1',
//        'password' => 'password1'
//    ],
//    [
//        'email' => 'email2@gmail.com',
//        'name' => 'name2',
//        'password' => 'password2'
//    ],
//    [
//        'email' => 'email3@gmail.com',
//        'name' => 'name3',
//        'password' => 'password3'
//    ],
//    [
//        'email' => 'email4@gmail.com',
//        'name' => 'name4',
//        'password' => 'password4'
//    ],
//    [
//        'email' => 'email5@gmail.com',
//        'name' => 'name5',
//        'password' => 'password5'
//    ],
//
//];
//
//$sqlQuery = "INSERT INTO `users` (`email`, `name`, `password`) VALUES ";
//
//foreach ($users as $user) {
//    $sqlQuery .= "('" . $user['email'] . "', '" . $user['name'] . "', '" . $user['password'] . "'),";
//}
//
//$sqlQuery = rtrim($sqlQuery, ',');

//$connect->query($sqlQuery);

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
<h1 class="form-title">Registration Page</h1>
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
        <form action="controllers/registration.php" method="post">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" id="fullName"
                       placeholder="Ruslan Krietsu" value="<?= getValue('register_form', 'name') ?>">
            </div>
            <?php if ($errors = getValidationErrors('name')) { ?>
                <?php include './templates/_validation_errors.php'; ?>
            <?php } ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email"
                       placeholder="Enter email" value="<?= getValue('register_form', 'email') ?>">
            </div>
            <?php if ($errors = getValidationErrors('email')) { ?>
                <?php include './templates/_validation_errors.php'; ?>
            <?php } ?>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password"
                       placeholder="Password">
            </div>
            <?php if ($errors = getValidationErrors('password')) { ?>
                <?php include './templates/_validation_errors.php'; ?>
            <?php } ?>
            <div class="mb-3">
                <label for="password-confirm" class="form-label">Password Confirm</label>
                <input type="password" name="password_confirm" class="form-control" id="password-confirm"
                       placeholder="Password confirm">
            </div>
            <?php if ($errors = getValidationErrors('password_confirm')) { ?>
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