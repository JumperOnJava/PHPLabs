<?php

include_once("database.php");

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$id = $_GET["id"];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $position = $_POST["position"];
    $salary = $_POST["salary"];

    $query = pdo()->prepare("UPDATE employees SET name = :name, position = :position, salary = :salary WHERE id = :id");
    $result = $query->execute([
        "name" => $name,
        "position" => $position,
        "salary" => $salary,
        "id" => $id
    ]);

    if ($result) {
        header("Location: index.php?updated=1");
        exit();
    } else {
        $message = "<div class='alert error'>Помилка оновлення даних працівника.</div>";
    }
}

$query = pdo()->prepare("SELECT * FROM employees WHERE id = :id");
$query->execute(["id" => $id]);
$employee = $query->fetch();

if (!$employee) {
    header("Location: index.php");
    exit();
}

echo "
    <h1>Редагувати дані працівника</h1>
    
    $message
    
<form method='post' action='edit.php?id=$id'>
    <label for='name'>Ім'я працівника:</label>
    <input type='text' name='name' value='".$employee['name']."' required>
                <br>
            
    <label for='position'>Посада:</label>
    <input type='text' name='position' value='".$employee['position']."' required>
                <br>
            
    <label for='salary'>Заробітна плата (грн):</label>
    <input type='number' name='salary' step='0.01' min='0' value='".$employee['salary']."' required>
                <br>
    <button type='submit' class='btn btn-warning'>Зберегти зміни</button>
    <a href='index.php'><button type='button' class='btn btn-default'>Скасувати</button></a>
</form>
";