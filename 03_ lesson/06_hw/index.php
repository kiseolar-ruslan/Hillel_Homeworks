<?php

//Завдання 1.
$numbers = [];

for ($i = 0; $i < 30; $i++ ) {
    $numbers[$i] = rand(1, 50);
}

//Завдання 2.
$sum = 0;

foreach ($numbers as $number) {
    $sum += $number;
}

echo 'Сума елементів масиву: ' . $sum . "<br>";

//Завдання 3.
$productOfNumbers = 1;

foreach ($numbers as $number) {
    $productOfNumbers *= $number;
}

echo 'Добуток елементів масиву: ' . $productOfNumbers . "<br>";

//Завдання 4.
$quantity = 0;
$value = 5;
foreach ($numbers as $number) {
    if ($number === $value) {
        $quantity++;
    }
}

echo 'Число 5 зустрічається в масиві: ' . $quantity . "<br>";

//Завдання 5.
$divides = [];

foreach ($numbers as $number) {
    if ($number % 3 === 0) {
        $divides[] = $number;
    }
}
print_r($divides);
echo "<br>";

//Завдання 6.
$min = 1;
$max = 50;

foreach ($numbers as $number) {
    if ($number > $min) {
        $min = $number;
    }
    //Я спочатку зробив через elseif, але потім зрозумів, що це дві різні інструкції.
    //Якщо не правий, виправте.
    //В будь-якому випадку, він працює :)
    if ($number < $max) {
        $max = $number;
    }
}
echo 'Максимальне значення: ' . $min . "<br>";
echo 'Мінімальне значення: ' . $max . "<br>";







