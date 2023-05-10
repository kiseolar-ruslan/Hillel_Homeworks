<?php
$fileDir = 'uploads';

$personalData = $_POST;
echo "<pre>";
print_r($personalData);

// Files data
$files = $_FILES;
echo "<pre>";
print_r($files);


$errorsList = [
    0 => "Ошибок не возникло, файл был успешно загружен на сервер.",
    1 => "Размер принятого файла превысил максимально допустимый размер.",
    2 => "Размер загружаемого файла превысил максимальное значение.",
    3 => "Загружаемый файл был получен только частично.",
    4 => "Файл не был загружен.",
    5 => "Отсутствует временная папка.",
    6 => "Не удалось записать файл на диск.",
    7 => "Остановка загрузки, неизвестная ошибка."
];

if ($files) {
    foreach ($files as $file) {
        //count elements in array
        if (is_array($file['name'])) {
            foreach ($file['name'] as $keys => $fil){
                if ($file['error'][$keys]) {
                    echo $errorsList[$file['error'][$keys]] . "<br>";
                    continue;
                }
                $fileTmp = $file['tmp_name'][$keys];
                $fileName = $file['name'][$keys];
                move_uploaded_file($fileTmp, "$fileDir/$fileName");
            }
        } else {
            if ($file['error']) {
                echo $errorsList[$file['error']] . "<br>";
                continue;
            }
            $fileTmp = $file['tmp_name'];
            $fileName = $file['name'];
            move_uploaded_file($fileTmp, "$fileDir/$fileName");
        }
    }
}









