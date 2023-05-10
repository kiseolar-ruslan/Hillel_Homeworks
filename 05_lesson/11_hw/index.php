<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hillel Homework</title>
</head>
<body>
<?php
/**
 * @param array $array
 * @param string $listTag
 * @return string
 */
function htmlList (array $array, string $listTag = "<ul>"): string
{
    foreach ($array as $item) {
        $listTag .= "<li> $item </li>";
    }

    $listTag .= "</ul>";

    return $listTag;
}
$randomArray = ['one', 'two', 'three'];
echo htmlList($randomArray, "<ol>");
?>
</body>
</html>
