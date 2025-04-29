<!DOCTYPE html>
<html>
Duplicates in array:
<?php
$array = [1,4,2,6,7,3,7,9,6,4,2,3,4,8];
$duplicates = [];
foreach($array as $value){
    $tmp = $duplicates[$value] ?? 0;
    $duplicates[$value] = $tmp+1;
}
foreach($duplicates as $key => $value){
    if($value > 1) {
        echo $key . ", ";
    }
}
?>
<br>
Random names:
<?php
$vowels = ["а", "е", "и", "о", "у", "і"];
$consonants = ["б", "в", "г", "д", "ж", "з", "к", "л", "м", "н", "п", "р", "с", "т", "ф", "х", "ц", "ч", "ш"];

for($j = 0; $j < 5; $j++){
echo "<br>";
    for($i = 0; $i < rand(2,6); $i++) {
    echo $consonants[rand(1,count($consonants)-1)];
    echo $vowels[rand(0,count($vowels)-1)];
}
}
?>
<br>
<?php

function createArray(): array
{
    $length = rand(3, 7);
    $array = [];

    for ($i = 0; $i < $length; $i++) {
        $array[] = rand(10, 20);
    }

    return $array;
}

function merge($array1, $array2): array
{
    $mergedArray = array_merge($array1, $array2);
    $uniqueArray = array_unique($mergedArray);
    sort($uniqueArray);
    return $uniqueArray;
}
$array1 = createArray();
$array2 = createArray();
echo "<br>Array 1: " . implode(", ", $array1) . PHP_EOL;
echo "<br>Array 2: " . implode(", ", $array2) . PHP_EOL;
$resultArray = merge($array1, $array2);
echo "<br>Final array: " . implode(", ", $resultArray) . PHP_EOL;
?>
<?php
$users = [
    "Олег" => 25,
    "Остап" => 30,
    "Стас" => 22,
    "Анастасія" => 28,
    "Богдан" => 26
];
function sortUsers(array $array, string $sortBy): array {
    if ($sortBy === "age") {
        asort($array);
    } elseif ($sortBy === "name") {
        ksort($array);
    }
    return $array;
}

$sortedByAge = sortUsers($users, "age");
$sortedByName = sortUsers($users, "name");
echo "<br>Сортування за віком: ";
print_r($sortedByAge);

echo "<br>Сортування за іменем: ";
print_r($sortedByName);
?>
</html>