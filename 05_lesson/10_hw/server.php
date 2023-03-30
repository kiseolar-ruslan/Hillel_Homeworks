<?php

$personalData = $_POST;

echo "<pre>";
print_r($personalData);

// Files data
$fileDir = 'uploads';
$files = $_FILES;

echo "<pre>";
print_r($files);


$errorsList = [
    "UPLOAD_ERR_OK" => "Ошибок не возникло, файл был успешно загружен на сервер.",
    "UPLOAD_ERR_INI_SIZE" => "Размер принятого файла превысил максимально допустимый размер.",
    "UPLOAD_ERR_FORM_SIZE" => "Размер загружаемого файла превысил максимальное значение.",
    "UPLOAD_ERR_PARTIAL" => "Загружаемый файл был получен только частично.",
    "UPLOAD_ERR_NO_FILE" => "Файл не был загружен.",
    "UPLOAD_ERR_NO_TMP_DIR" => "Отсутствует временная папка.",
    "UPLOAD_ERR_CANT_WRITE" => "Не удалось записать файл на диск.",
    "UPLOAD_ERR_EXTENSION" => "Остановка загрузки, неизвестная ошибка."
];


if ($files) {
    foreach ($files as $file) {
        //count elements in array
        if (is_array($file['name'])) {
            $length = count($file['name']);
            for ($i = 0; $i < $length; $i++) {
                if ($file['error'][$i]) {
                    echo 'Error';
                    continue;
                }
//            mkdir($fileDir);
                $fileTmp = $file['tmp_name'][$i];
                $fileName = $file['name'][$i];
                move_uploaded_file($fileTmp, "$fileDir/$fileName");
            }
        } else {
            if ($file['error']) {
                echo 'Error';
                continue;
            }
//            mkdir($fileDir);
            $fileTmp = $file['tmp_name'];
            $fileName = $file['name'];
            move_uploaded_file($fileTmp, "$fileDir/$fileName");
        }
    }
}

//if ($file['error'] === $errorsList[0]) {
//    echo $errorsList[0][0];
//}
//if ($file['error'] === $errorsList[1]) {
//    echo $errorsList[0][1];
//}
//if ($file['error'] === $errorsList[2]) {
//    echo $errorsList[0][2];
//}
//if ($file['error'] === $errorsList[3]) {
//    echo $errorsList[0][3];
//}
//if ($file['error'] === $errorsList[4]) {
//    echo $errorsList[0][4];
//}
//if ($file['error'] === $errorsList[5]) {
//    echo $errorsList[0][5];
//}
//if ($file['error'] === $errorsList[6]) {
//    echo $errorsList[0][6];
//}
//if ($file['error'] === $errorsList[7]) {
//    echo $errorsList[0][7];
//}
//if ($file['error'] === $errorsList[8]) {
//    echo $errorsList[0][7];
//}













