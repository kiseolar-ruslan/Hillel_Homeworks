<?php
//$filesDir = 'files';

//foreach ($_FILES as $file) {
//    //check errors
//    if ($file['error']) {
//        echo 'Errors';
//        exit;
//    }
//
//    $fileName = $file['name'];
//    $tmpName = $file['tmp_name'];
//
//    move_uploaded_file($tmpName, "$filesDir/$fileName");
//}

$personalData = [];

foreach ($_POST as $key => $item) {
    $personalData[$key] = $item;
}
echo "<pre>";
print_r($personalData);


// Завдання з зірочкою для охочих *
// Продублював код с перенесенням викачуваного файлу, не впевнений
// Що це найкращий спосіб, але іншого не бачу
$fileDir = 'uploads';

foreach ($_FILES as $file) {
    $fileName = $file['name'];
    $tmpName = $file['tmp_name'];

    if (is_dir($fileDir)) {
        move_uploaded_file($tmpName, "$fileDir/$fileName");
    } else {
        mkdir($fileDir);
        move_uploaded_file($tmpName, "$fileDir/$fileName");
    }
}













