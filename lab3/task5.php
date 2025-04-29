<?php
$message = '';
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST["login"]);
    $password = trim($_POST["password"]);

    if (empty($login) || empty($password)) {
        $error = "Необхідно заповнити всі поля!";
    } else {
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $login)) {
            $error = "Логін може містити тільки латинські букви, цифри, символи '_' та '-'";
        } else {
            $user_dir = "./" . $login;

            if (file_exists($user_dir) && is_dir($user_dir)) {
                $error = "Користувач з логіном '$login' вже існує!";
            } else {
                if (mkdir($user_dir, 0755)) {
                    mkdir($user_dir . "/video", 0755);
                    mkdir($user_dir . "/music", 0755);
                    mkdir($user_dir . "/photo", 0755);

                    file_put_contents($user_dir . "/video/sample_video.txt", "Це файл у папці відео");
                    file_put_contents($user_dir . "/music/sample_music.txt", "Це файл у папці музики");
                    file_put_contents($user_dir . "/photo/sample_photo.txt", "Це файл у папці фото");

                    $users_file = "users.json";
                    $users_data = [];

                    if (file_exists($users_file)) {
                        $json_content = file_get_contents($users_file);
                        if (!empty($json_content)) {
                            $users_data = json_decode($json_content, true);
                        }
                    }
                    $users_data[$login] = [
                        'password' => $password,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    file_put_contents($users_file, json_encode($users_data, JSON_PRETTY_PRINT));
                    $success = "Папка користувача '$login' та її структура успішно створені!";
                } else {
                    $error = "Виникла помилка при створенні папки користувача!";
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
    <title>Створення папки користувача</title>
</head>
<body>
<h2>Створення папки користувача</h2>

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
        <input type="submit" value="Створити папку">
    </div>
</form>

<p><a href="delete.php">Перейти на сторінку видалення папки</a></p>
</body>
</html>