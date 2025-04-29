<?php
require_once "Function/func.php";

$x = isset($_POST['x']) ? floatval($_POST['x']) : 0;
$y = isset($_POST['y']) ? floatval($_POST['y']) : 0;

$x_y = power($x, $y);
$x_fact = factorial($x);
$sin_x = sin($x);
$cos_x = cos($x);
$tg_x = my_tg($x);

echo "<table border='1' style='background-color:yellow;'>";
echo "<tr><th>x^y</th><th>x!</th><th>my_tg(x)</th><th>sin(x)</th><th>cos(x)</th><th>tg(x)</th></tr>";
echo "<tr><td>$x_y</td><td>$x_fact</td><td>$tg_x</td><td>$sin_x</td><td>$cos_x</td><td>" . tan($x) . "</td></tr>";
echo "</table>";
?>
