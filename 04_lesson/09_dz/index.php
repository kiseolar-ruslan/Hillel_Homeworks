<?php

$vacancies = [
    0 => ['id' => 1, 'title' => 'PHP Programmer', 'salary' => 2500, 'sector_id' => 1],
    1 => ['id' => 2, 'title' => 'Designer', 'salary' => 3000, 'sector_id' => 1],
    2 => ['id' => 3, 'title' => 'Finance Manager', 'salary' => 3500, 'sector_id' => 2],
    3 => ['id' => 4, 'title' => 'Finance Director', 'salary' => 3500, 'sector_id' => 2],
];

$sectors = [
    0 => ['id' => 1, 'title' => 'IT'],
    1 => ['id' => 2, 'title' => 'Finance']
];

$fullVacancies = [];
foreach ($vacancies as $key => $vacancy) {
    foreach ($sectors as $sector) {
        if ($vacancy['sector_id'] === $sector['id']) {
            $vacancy['sector_title'] = $sector['title'];
            unset($vacancy['sector_id']);
            $fullVacancies[] = $vacancy;
            continue 2;
        }
    }
}


//$keysArray = []; // пустой массив для ключей.

//foreach ($fullVacancies as $fullVacancy) {
//    foreach ($fullVacancy as $key =>  $item) {
//        $keysArray[$key] = []; // добавляем ключи в пустой массив.
//    }
//}
//
//print_r($keysArray); // выводим ключи.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hillel Homework</title>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Salary</th>
            <th>Sector Title</th>
        </tr>
    </thead>
    <tbody>
    <!--data table-->
    <?php
    foreach ($fullVacancies as $fullVacancy) {
        echo "<tr>";
        echo "<td>" . $fullVacancy['id'] . "</td>";
        echo "<td>" . $fullVacancy['title'] . "</td>";
        echo "<td>" . $fullVacancy['salary'] . "</td>";
        echo "<td>" . $fullVacancy['sector_title'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>
