<?php
function factorial($n) {
    if ($n == 0) return 1;
    return $n * factorial($n - 1);
}

function my_tg($x) {
    return sin($x) / cos($x);
}

function power($x, $y) {
    return pow($x, $y);
}

