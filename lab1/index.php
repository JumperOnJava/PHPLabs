<!DOCTYPE html>
<html>
<body>
<h1>Task 1</h1>
    <span>Wampserver is installed!</span>
<h1>Task 2</h1>
    <?php
    echo "<p>Полину в мріях в купель океану,<br>
    Відчую <strong>шовковистість</strong> глибини,<br>
    Чарівні мушлі з дна собі дістану,<br>
    Щоб <em>взимку</em></p>";

    echo "<p><u>тішили</u><br>
    &nbsp;&nbsp;&nbsp;&nbsp;мене<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;вони…</p>";
    ?>

<h1>Task 3</h1>

    <?php
    $uah = 1500;
    $json = file_get_contents("https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd.json");
    $rate = json_decode($json,true)["usd"]["uah"];
    $usd = $uah / $rate;
    echo "<span>$uah гривень можна обміняти на $usd доларів </span>"
    ?>

<h1>Task 4</h1>
<?php
    $month = 5;
    if($month == 1)
        echo "<span>january</span>";
    if($month == 2)
        echo "<span>february</span>";
    if($month == 3)
        echo "<span>march</span>";
    if($month == 4)
        echo "<span>april</span>";
    if($month == 5)
        echo "<span>may</span>";
    if($month == 6)
        echo "<span>june</span>";
    if($month == 7)
        echo "<span>july</span>";
    if($month == 8)
        echo "<span>august</span>";
    if($month == 9)
        echo "<span>september</span>";
    if($month == 10)
        echo "<span>october</span>";
    if($month == 11)
        echo "<span>november</span>";
    if($month == 12)
        echo "<span>december</span>";
?>
<h1>Task 5</h1>
<?php
    $char = 'x';
    switch ($char) {
        case 'e':
        case 'y':
        case 'u':
        case 'i':
        case 'o':
        case 'a':
            echo "<span>vowel</span>";
            break;
        default:
            echo "<span>consonant</span>";
            break;
    }
?>
<h1>Task 6</h1>
<?php
$rand = mt_rand(100,999);
echo "<span>number = $rand</span><br>";
$nums = [intdiv($rand,100),intdiv($rand,10)%10,$rand%10];
$sum = array_sum($nums);
echo "<span>numbers sum = $sum</span><br>";
echo "<span>numbers reversed = $nums[2]$nums[1]$nums[0]</span><br>";
sort($nums);
echo "<span>numbers sorted largest = $nums[2]$nums[1]$nums[0]</span><br>";
?>

<h1>Task 7</h1>
<table>
<?php
$size = 10;

    for($i = 0; $i < $size; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $size; $j++)
        {
            $random_color = str_pad(dechex(mt_rand(0, 0xFFFFFF)),6, "0", STR_PAD_LEFT);
            echo "<td>";
            echo "<div style='width: 40px; height: 40px; background-color: #$random_color'></div>";
        }
    }
?>
</table>
<div style='width: 440px; height: 440px; background-color: black; position: relative;'>
    <?php
    for($i = 0; $i < $size; $i++) {

        $randred = mt_rand(64,255);
        $randx = mt_rand(0,400);
        $randy = mt_rand(0,400);
        echo "<div style='width: 40px; height: 40px; position: absolute; top: ".$randx."px;left: ".$randy."px; background-color: rgb($randred, 0,0);'></div>";
    }
    ?>
</div>
</body>
</html>