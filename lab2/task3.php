<?php
session_start();

$lang = $_GET['lang'] ?? $_COOKIE['lang'] ?? "en";
setcookie("lang", $lang, time() + (86400 * 30 * 6), "/");

$login = $_SESSION['login'] ?? '';
$password1 = $_SESSION['password1'] ?? '';
$password2 = $_SESSION['password2'] ?? '';
$gender = $_SESSION['gender'] ?? '';
$city = $_SESSION['city'] ?? '';
$games = $_SESSION['games'] ?? [];
$about = $_SESSION['about'] ?? '';

$translations = [
    "en" => [
        "title" => "Registration Form",
        "login" => "Login:",
        "password" => "Password:",
        "password_repeat" => "Password (again):",
        "gender" => "Gender:",
        "male" => "Male",
        "female" => "Female",
        "city" => "City:",
        "games" => "Favorite games:",
        "about" => "About yourself:",
        "photo" => "Photo:",
        "submit" => "Register",
        "language" => "Selected language: English",
    ],
    "ua" => [
        "title" => "Форма реєстрації",
        "login" => "Логін:",
        "password" => "Пароль:",
        "password_repeat" => "Пароль (ще раз):",
        "gender" => "Стать:",
        "male" => "чоловік",
        "female" => "жінка",
        "city" => "Місто:",
        "games" => "Улюблені ігри:",
        "about" => "Про себе:",
        "photo" => "Фотографія:",
        "submit" => "Зареєструватися",
        "language" => "Вибрана мова: Українська",
    ],
    "es" => [
        "title" => "Formulario de registro",
        "login" => "Usuario:",
        "password" => "Contraseña:",
        "password_repeat" => "Contraseña (de nuevo):",
        "gender" => "Género:",
        "male" => "Hombre",
        "female" => "Mujer",
        "city" => "Ciudad:",
        "games" => "Juegos favoritos:",
        "about" => "Sobre ti:",
        "photo" => "Foto:",
        "submit" => "Registrarse",
        "language" => "Idioma seleccionado: Español"
    ]
];

$trans = $translations[$lang] ?? $translations["en"];

$cityOptions = [
    "Zhytomyr" => ($city == "Zhytomyr") ? "selected" : "",
    "Kyiv" => ($city == "Kyiv") ? "selected" : "",
    "Lviv" => ($city == "Lviv") ? "selected" : ""
];

$genderMale = ($gender == $trans["male"]) ? "checked" : "";
$genderFemale = ($gender == $trans["female"]) ? "checked" : "";

$gameOptions = [
    "Football" => in_array("Football", $games) ? "checked" : "",
    "Basketball" => in_array("Basketball", $games) ? "checked" : "",
    "Volleyball" => in_array("Volleyball", $games) ? "checked" : "",
    "Chess" => in_array("Chess", $games) ? "checked" : "",
    "Fortnite" => in_array("Fortnite", $games) ? "checked" : ""
];

echo "
<!DOCTYPE html>
<html lang=\"$lang\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>{$trans["title"]}</title>
</head>
<body>
<form action=\"formResult.php\" method=\"post\" enctype=\"multipart/form-data\">
    <table>
        <tr>
            <td>{$trans["login"]}</td>
            <td><input type=\"email\" name=\"login\" value=\"" . htmlspecialchars($login) . "\" required></td>
        </tr>
        <tr>
            <td>{$trans["password"]}</td>
            <td><input type=\"password\" name=\"password1\" value=\"" . htmlspecialchars($password1) . "\" required></td>
        </tr>
        <tr>
            <td>{$trans["password_repeat"]}</td>
            <td><input type=\"password\" name=\"password2\" value=\"" . htmlspecialchars($password2) . "\" required></td>
        </tr>
        <tr>
            <td>{$trans["gender"]}</td>
            <td>
                <input type=\"radio\" name=\"gender\" value=\"{$trans["male"]}\" $genderMale required> {$trans["male"]}
                <input type=\"radio\" name=\"gender\" value=\"{$trans["female"]}\" $genderFemale required> {$trans["female"]}
            </td>
        </tr>
        <tr>
            <td>{$trans["city"]}</td>
            <td>
                <select name=\"city\">
                    <option value=\"Zhytomyr\" {$cityOptions["Zhytomyr"]}>Zhytomyr</option>
                    <option value=\"Kyiv\" {$cityOptions["Kyiv"]}>Kyiv</option>
                    <option value=\"Lviv\" {$cityOptions["Lviv"]}>Lviv</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>{$trans["games"]}</td>
            <td>
                <input type=\"checkbox\" name=\"games[]\" value=\"Football\" {$gameOptions["Football"]}> Football<br>
                <input type=\"checkbox\" name=\"games[]\" value=\"Basketball\" {$gameOptions["Basketball"]}> Basketball<br>
                <input type=\"checkbox\" name=\"games[]\" value=\"Volleyball\" {$gameOptions["Volleyball"]}> Volleyball<br>
                <input type=\"checkbox\" name=\"games[]\" value=\"Chess\" {$gameOptions["Chess"]}> Chess<br>
                <input type=\"checkbox\" name=\"games[]\" value=\"Fortnite\" {$gameOptions["Fortnite"]}> Fortnite
            </td>
        </tr>
        <tr>
            <td>{$trans["about"]}</td>
            <td><textarea name=\"about\">" . htmlspecialchars($about) . "</textarea></td>
        </tr>
        <tr>
            <td>{$trans["photo"]}</td>
            <td><input type=\"file\" name=\"photo\" accept=\"image/*\" required></td>
        </tr>
        <tr>
            <td colspan=\"2\">
                <input type=\"submit\" value=\"{$trans["submit"]}\">
            </td>
        </tr>
    </table>
    <div>
    <a href='?lang=ua'><img src='https://cdn.jsdelivr.net/gh/hampusborgos/country-flags@main/svg/ua.svg' width='40' height='30'></a>
    <a href='?lang=en'><img src='https://cdn.jsdelivr.net/gh/hampusborgos/country-flags@main/svg/us.svg' width='40' height='30'></a>
    <a href='?lang=es'><img src='https://cdn.jsdelivr.net/gh/hampusborgos/country-flags@main/svg/es.svg' width='40' height='30'></a>
    </div>
   
</form>
<b>{$trans['language']}</b>
</body>
</html>
";
?>