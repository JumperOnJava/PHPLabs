<?php

include_once("database.php");


if(!isset($_COOKIE["token"])){
    header("Location: index.php?wrong_token=1");
}
$token_full = explode("|", $_COOKIE["token"]);
$username = $token_full[0];
$token = $token_full[1];

$query_user = pdo()->prepare("SELECT * FROM users WHERE username = :username");
$query_user->execute(["username" => $username]);
$user = $query_user->fetch();

if($user["cookie"] != $token){
    echo "wrong_token";
    setcookie("token", "", time());
    header("Location: index.php?wrong_token=2");
    return;
}
if(isset($_POST["action_type"])) {
    if ($_POST["action_type"] == "logout") {
        setcookie("token", "", time());
        header("Location: index.php");
        return;
    }
    if ($_POST["action_type"] == "delete_account") {
        pdo()->prepare("DELETE FROM users WHERE username = (:username)")->execute(["username" => $username]);
        setcookie("token", "", time());
        header("Location: index.php");
        return;
    }
    if ($_POST["action_type"] == "update_profile") {
        $new_role = $_POST["role"];
        $new_birthday = $_POST["birthday"];

        $update_query = pdo()->prepare("UPDATE users SET role = :role, birthday = :birthday WHERE username = :username");
        $update_query->execute([
            "role" => $new_role,
            "birthday" => $new_birthday,
            "username" => $username
        ]);

        header("Location: home.php?updated=1");
        return;
    }
}

$update_message = "";
if(isset($_GET["updated"]) && $_GET["updated"] == 1) {
    $update_message = "<span style=\"color: green;\">Profile updated successfully!</span><br>";
}

echo "
<span> Logged in as ".$user["username"]."</span>    
<br><hr>
".$update_message. "
<hr>
<form action='home.php' method='post'>
<input type='hidden' name='action_type' value='update_profile'>
<label for='birthday'>Date of Birth:</label>
<input type='date' name='birthday' value='" .$user["birthday"]."'><br>
<label for='role'>Role:</label>
<select name='role'>
    <option value='reader' ".($user["role"] == "reader" ? "selected" : "").">Reader</option>
    <option value='author' ".($user["role"] == "author" ? "selected" : ""). ">Author</option>
</select><br>
<input type='submit' name='update_profile' value='Update Profile'>
</form>
<hr>
<form action='home.php' method='post'>
<input type='hidden' name='action_type' value='logout'>
<input type='submit' name='logout' value='Logout'>
</form> 
<form action='home.php' method='post'>
<input type='hidden' name='action_type' value='delete_account'>
<input type='submit' name='delete_account' value='Delete Account'>
</form>
";