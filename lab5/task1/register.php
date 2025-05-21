<?php

include("database.php");

$password_rep_failed = false;
$age_check_failed = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_rep = $_POST["password_rep"];
    $birthday = $_POST["birthday"];
    $role = $_POST["role"] ?? "reader";

    if($password_rep != $password){
        html_response(["password_rep_failed"]);
        return;
    }

    $birthdate = new DateTime($birthday);
    $today = new DateTime();
    $age = $today->diff($birthdate)->y;

    if($age < 13){
        html_response(["age_check_failed"]);
        return;
    }

    $query = pdo()->prepare("SELECT * FROM users WHERE username = (:username)");
    $query->execute(["username"=>$username]);

    if($query->rowCount() > 0){
        html_response(["username_taken"]);
        return;
    }

    $random_cookie = generateRandomString(100);

    pdo()->prepare("INSERT INTO users (username, password, birthday, role, cookie, last_login, score, restricted, gps_x, gps_y) 
                   VALUES (:username, :password, :birthday, :role, :cookie, NOW(), 0, 0, 0, 0)")
        ->execute([
            "username" => $username,
            "password" => $password,
            "birthday" => $birthday,
            "role" => $role,
            "cookie" => $random_cookie,
        ]);

    setCookie("token", $username."|".$random_cookie, time() + (86400 * 30));

    redirect_response();
}

html_response([]);

function redirect_response(){
    header("Location: home.php");
    exit(0);
}

function html_response(array $arg)
{
    if(in_array("password_rep_failed", $arg)){
        echo "<span style=\"color: red;\">Passwords do not match!</span>";
    }
    if(in_array("username_taken", $arg)){
        echo "<span style=\"color: orangered;\">Username already taken!</span>";
    }
    if(in_array("age_check_failed", $arg)){
        echo "<span style=\"color: red;\">You must be at least 13 years old to register.</span>";
    }

    echo "
<form method='post' action='register.php'>
    <input type='text' name='username' placeholder='Username' required><br>
    <input type='password' name='password' placeholder='Password' required><br>
    <input type='password' name='password_rep' placeholder='Repeat password' required><br>
    <label for='birthday'>Date of Birth:</label>
    <input type='date' name='birthday' required><br>
    <label for='role'>Role:</label>
    <select name='role'>
        <option value='reader' selected>Reader</option>
        <option value='author'>Author</option>
    </select><br>
    <input type='submit' name='submit' value='Register'>
</form> 
";
    exit(0);
}