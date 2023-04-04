<?php
//1.Створіть функцію, яка приймає масив чисел та функцію, яка визначає,
// які елементи масиву повинні бути включені в новий масив. Поверніть новий
// масив з елементами, які відповідають умові, використовуючи callback функцію
// (В якості callback функції напишіть анонімну функцію яка перевіряє чи є число парним).
function filterNumbers($array, $callBack)
{
    $newArray = [];
    foreach ($array as $item) {
        if ($callBack($item)) {
            $newArray[] = $item;
        }
    }
    return $newArray;
}

$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,];
$randomNumbers = filterNumbers($numbers, function ($num) {
    return $num % 2 === 0;
});
print_r($randomNumbers);
echo "<br>";

//2.Створіть стрілочну функцію, яка приймає 2 числа та повертає їх різницю.
$difference = fn($a, $b) => $a - $b;
echo $difference(150, 50) . "<br>";

//3.Напишіть анонімну функцію, яка приймає масив чисел і повертає суму всіх чисел,
// які більше за 10.
$numbers = function (array $array) {
    $number = 0;
    foreach ($array as $item) {
        if ($item > 10) {
            $number += $item;
        }
    }
    return $number;
};
$abc = [10, 20, 30, 40, 1,];
echo $numbers($abc) . "<br>";

//4. Напишіть стрілочну функцію, яка приймає рядок і повертає новий рядок де перша
// літера у верхньому регістрі.Використайте цю функцію для рішення задачі:
// Є масив з рядками, треба для кожного елемента змінити першу літеру
// у верхній регістр. (для проходження по всім елементам масиву
// використовувати одну з php функцій).
$upperWords = fn($string) => ucfirst($string);
$arrayStrings = ['apple', 'samsung', 'xiaomi'];
array_walk($arrayStrings, function(&$value) use ($upperWords) {
    $value = $upperWords($value);
});
print_r($arrayStrings);
echo "<br>";

//5. Напишіть функцію, яка множить кожен елемент масиву на число, передане
// до функції за ссилкою.
$number = 2;
$randomArray = [1, 2, 3, 4, 5,];
function myFunction(array $array, string $number) : array
{
    for ($i = 0; $i < count($array); $i++) {
        $array[$i] *= $number;
    }
    return $array;
}
print_r(myFunction($randomArray, $number));




