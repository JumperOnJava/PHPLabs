<?php
//formResult.php
session_start(); // Додаємо сесію

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lang = $_COOKIE['lang'] ?? "en";

    // Зберігаємо дані форми в сесії
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['password1'] = $_POST['password1'];
    $_SESSION['password2'] = $_POST['password2'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['games'] = $_POST['games'] ?? [];
    $_SESSION['about'] = $_POST['about'];
    // Фотографію не зберігаємо в сесії, як зазначено в завданні

    // Language strings
    $translations = [
        "en" => [
            "title" => "Registration Result",
            "login" => "Login:",
            "password" => "Password:",
            "password_match" => "matches",
            "password_mismatch" => "does not match (first - %d characters, second - %d characters)",
            "gender" => "Gender:",
            "city" => "City:",
            "games" => "Favorite games:",
            "about" => "About yourself:",
            "photo" => "Photo:",
            "back" => "Return to main page"
        ],
        "ua" => [
            "title" => "Результат реєстрації",
            "login" => "Логін:",
            "password" => "Пароль:",
            "password_match" => "пароль співпадає",
            "password_mismatch" => "не співпадає (перший - %d символів, другий - %d символів)",
            "gender" => "Стать:",
            "city" => "Місто:",
            "games" => "Улюблені ігри:",
            "about" => "Про себе:",
            "photo" => "Фотографія:",
            "back" => "Повернутися на головну сторінку"
        ],
        "es" => [
            "title" => "Resultado del registro",
            "login" => "Usuario:",
            "password" => "Contraseña:",
            "password_match" => "coincide",
            "password_mismatch" => "no coincide (primero - %d caracteres, segundo - %d caracteres)",
            "gender" => "Género:",
            "city" => "Ciudad:",
            "games" => "Juegos favoritos:",
            "about" => "Sobre ti:",
            "photo" => "Foto:",
            "back" => "Volver a la página principal"
        ]
    ];

    $trans = $translations[$lang] ?? $translations["en"];

    $login = htmlspecialchars($_POST['login']);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $gender = htmlspecialchars($_POST['gender']);
    $city = htmlspecialchars($_POST['city']);
    $games = $_POST['games'] ?? [];
    $about = nl2br(htmlspecialchars($_POST['about']));

    $passwordMessage = ($password1 === $password2) ? $trans["password_match"] : sprintf($trans["password_mismatch"], strlen($password1), strlen($password2));

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photoString = "data:" . $_FILES["photo"]['type'] . ";base64," . base64_encode(file_get_contents($_FILES['photo']['tmp_name']));
    }
    ?>

    <!DOCTYPE html>
    <html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $trans["title"]; ?></title>
    </head>
    <body>
    <p><strong><?php echo $trans["login"]; ?></strong> <?php echo $login; ?></p>
    <p><strong><?php echo $trans["password"]; ?></strong> <?php echo $passwordMessage; ?></p>
    <p><strong><?php echo $trans["gender"]; ?></strong> <?php echo $gender; ?></p>
    <p><strong><?php echo $trans["city"]; ?></strong> <?php echo $city; ?></p>
    <p><strong><?php echo $trans["games"]; ?></strong> <?php echo implode(", ", $games); ?></p>
    <p><strong><?php echo $trans["about"]; ?></strong><br><?php echo $about; ?></p>

    <?php if (isset($photoString)): ?>
        <p><strong><?php echo $trans["photo"]; ?></strong></p>
        <img src="<?php echo $photoString; ?>" alt="<?php echo $trans["photo"]; ?>" style="max-width: 300px;">
    <?php endif; ?>

    <p><a href="task3.php?lang=<?php echo $lang; ?>"><?php echo $trans["back"]; ?></a></p>
    </body>
    </html>

    <?php
}
?>