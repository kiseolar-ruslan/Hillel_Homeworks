<?php
$a = null;

if (isset($a)) {
    echo $a;
} else {
    echo 'NULL';
}

//Цей самий вираз за допомогою тернарного оператора.
echo isset($a) ? $a : 'NULL';




