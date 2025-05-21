<?php

include_once("database.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $cost = $_POST["cost"];
    $amount = $_POST["amount"];
    $date = $_POST["date"];

    $query = pdo()->prepare("INSERT INTO tov (name, cost, amount, date) VALUES (:name, :cost, :amount, :date)");
    $result = $query->execute([
        "name" => $name,
        "cost" => $cost,
        "amount" => $amount,
        "date" => $date
    ]);

    if ($result) {
        $lastId = pdo()->lastInsertId();
        $message = "<span style='color: green;'>Запис успішно додано. ID: " . $lastId . "</span>";
    } else {
        $message = "<span style='color: red;'>Помилка додавання запису.</span>";
    }
}

echo "
    <h1>Додати новий товар</h1>
    " . $message . "
        <form method='post' action='insert.php'>
            <label for='name'>Назва товару:</label>
            <input type='text' name='name' required>
            <br>
            
            <label for='cost'>Вартість:</label>
            <input type='number' name='cost' step='0.01' required>
            <br>
            
            <label for='amount'>Кількість:</label>
            <input type='number' name='amount' required>
            <br>
         
            <label for='date'>Дата:</label>
            <input type='date' name='date' required>
            <br>
            
            <input type='submit' value='Додати'>
            <a href='index.php'><button type='button'>Назад до списку</button></a>
        </form>
";