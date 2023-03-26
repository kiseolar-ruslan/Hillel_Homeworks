<?php
$filesDir = 'files';

foreach ($_FILES as $file) {
    //check errors
    if ($file['error']) {
        echo 'Errors';
        exit;
    }

    $fileName = $file['name'];
    $tmpName = $file['tmp_name'];

    move_uploaded_file($tmpName, "$filesDir/$fileName");
}

$personalData = [];

foreach ($_POST as $key => $item) {
    $personalData[$key] = $item;
}
echo "<pre>";
print_r($personalData);











