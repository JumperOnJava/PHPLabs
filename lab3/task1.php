<?php
$font_size = $_GET["font_size"] ??  $_COOKIE["font_size"] ?? 16;
setcookie("font_size", $_GET["font_size"] ?? $font_size, time() + (86400 * 30), "/");
$_COOKIE["font_size"] = $font_size;

if ($_GET["username"] ?? "" == "Admin" && $_GET["password"] ?? "" == "password") {
    setcookie("user", "Admin", time() + (86400 * 30), "/");
    $_COOKIE["user"] = "Admin";
}
if ($_GET["logout"] ?? "" == "1") {
    setcookie("user", "", time() - 3600, "/");
    $_COOKIE["user"] = "";
}

echo "<!DOCTYPE html>
<html>
<head>
    <style>
        body, input {
            font-size: {$font_size}px;
        }
    </style>
</head>
<body>
    Font size: <br>
    <a href='task1.php?font_size=12'>small font</a>
    <a href='task1.php?font_size=16'>medium font</a>
    <a href='task1.php?font_size=20'>large font</a>
    <br><br>
    <form method='get' action='task1.php'>
        " . (($_COOKIE["user"] ?? "") != ""
        ? "<span>Hello, " . ($_COOKIE["user"] ?? "unknown") . "!</span><br>
           <a href='task1.php?logout=1'>Log out</a>"
        :
        "<input type='text' name='username' placeholder='Username'>
            <input type='text' name='password' placeholder='Password'>
            <input type='submit' name='submit' value='submit'>")
    . "
    </form>
</body> 
</html>";
