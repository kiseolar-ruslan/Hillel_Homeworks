<?php
session_start();

include_once __DIR__ . '/database/database.php';
include_once __DIR__ . '/functions/functions.php';

$users = [
    [
        'email' => 'email1@gmail.com',
        'name' => 'name1',
        'password' => 'password1'
    ],
    [
        'email' => 'email2@gmail.com',
        'name' => 'name2',
        'password' => 'password2'
    ],
    [
        'email' => 'email3@gmail.com',
        'name' => 'name3',
        'password' => 'password3'
    ],
    [
        'email' => 'email4@gmail.com',
        'name' => 'name4',
        'password' => 'password4'
    ],
    [
        'email' => 'email5@gmail.com',
        'name' => 'name5',
        'password' => 'password5'
    ],

];

$sqlQuery = "INSERT INTO `users` (`email`, `name`, `password`) VALUES ";

foreach ($users as $user) {
    $sqlQuery .= "('" . $user['email'] . "', '" . $user['name'] . "', '" . $user['password'] . "'),";
}

$sqlQuery = rtrim($sqlQuery, ',');


//$connect->query($sqlQuery);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hillel</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<h1 class="form-title">Registration Page</h1>
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
        <form action="controllers/registration.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" id="fullName"
                       placeholder="Ruslan Krietsu">
            </div>
            <?php if (existsMessages('alerts')) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    foreach (getMessages('alerts') as $warnings) {
                        foreach ($warnings['name'] as $warning) {
                            echo $warning . "<br>";
                        }
                    }
                    ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email"
                       placeholder="Enter email">
            </div>
            <?php if (existsMessages('alerts')) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    foreach (getMessages('alerts') as $warnings) {
                        foreach ($warnings['email'] as $warning) {
                            echo $warning . "<br>";
                        }
                    }
                    ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password"
                       placeholder="Password">
            </div>
            <?php if (existsMessages('alerts')) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    foreach (getMessages('alerts') as $warnings) {
                        foreach ($warnings['password'] as $warning) {
                            echo $warning . "<br>";
                        }
                    }
                    ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="password-confirm" class="form-label">Password Confirm</label>
                <input type="password" name="password_confirm" class="form-control" id="password-confirm"
                       placeholder="Password confirm">
            </div>
            <?php if (existsMessages('alerts')) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    foreach (getMessages('alerts') as $warnings) {
                        foreach ($warnings['password_confirm'] as $warning) {
                            echo $warning . "<br>";
                        }
                    }
                    ?>
                </div>
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