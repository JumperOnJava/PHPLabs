<?php

include("database.php");


if(isset($_GET["wrong_token"])){
    html_response(["wrong_token"]);
}
if(isset($_COOKIE["token"])){
    redirect_response();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = pdo()->prepare("SELECT * FROM users WHERE username = (:username)");
    $query->execute(["username"=>$username]);

    if($query->rowCount() == 0){
        html_response(["wrong_login_data"]);
    }

    $user = $query->fetch();
    if($user["password"] == $password){
        $random_cookie = generateRandomString(100);
        $query_set_token = pdo()->prepare("UPDATE users SET cookie = (:token) WHERE username = (:username)");
        $query_set_token->execute(["token"=>$random_cookie, "username"=>$username]); // line 28
        setCookie("token", $username."|".$random_cookie, time() + (86400 * 30));
        redirect_response();
        return;
    }
    html_response(["wrong_login_data"]);

}

html_response([]);

function redirect_response(){
    header("Location: home.php");
    exit(0);
}
function html_response(array $arg)
{
    if(in_array("wrong_token",$arg)){
        echo "<span>Outdated or missing data, Log in again</span>";
    }
    if(in_array("wrong_login_data", $arg)){
        echo "<span style=\"color: red;\">Invalid login credentials</span>";
    }
    echo ">Register</a><br>
    
</form> 
\"";
    exit(0);
}