<?php
$message = '';
$error = '';
$success = '';
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST["login"]);
    $password = trim($_POST["password"]);

    if (empty($login) || empty($password)) {
        $error = "Необхідно заповнити всі поля!";
    } else {
        $user_dir = "./" . $login;

        if (!file_exists($user_dir) || !is_dir($user_dir)) {
            $error = "Папки з логіном '$login' не існує!";
        } else {
            $users_file = "users.json";
            $valid_password = false;

            if (file_exists($users_file)) {
                $json_content = file_get_contents($users_file);
                if (!empty($json_content)) {
                    $users_data = json_decode($json_content, true);

                    if (isset($users_data[$login]) && $users_data[$login]['password'] === $password) {
                        $valid_password = true;
                    }
                }
            }

            if (!$valid_password) {
                $error = "Неправильний пароль для користувача '$login'!";
            } else {
                if (deleteDirectory($user_dir)) {
                    unset($users_data[$login]);
                    file_put_contents($users_file, json_encode($users_data, JSON_PRETTY_PRINT));

                    $success = "Папка користувача '$login' успішно видалена разом з усім вмістом!";
                } else {
                    $error = "Виникла помилка при видаленні папки!";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Видалення папки користувача</title>
</head>
<body>
<h2>Видалення папки користувача</h2>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p style="color: green;"><?php echo $success; ?></p>
<?php endif; ?>

<form method="POST" action="">
    <div>
        <label for="login">Логін:</label><br>
        <input type="text" id="login" name="login" required>
    </div>
    <br>
    <div>
        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password" required>
    </div>
    <br>
    <div>
        <input type="submit" value="Видалити папку">
    </div>
</form>

<p><a href="create_dir.php">Повернутися на сторінку створення папки</a></p>
</body>
</html>