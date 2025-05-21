<?php

include_once("database.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $position = $_POST["position"];
    $salary = $_POST["salary"];

    $query = pdo()->prepare("INSERT INTO employees (name, position, salary) VALUES (:name, :position, :salary)");
    $result = $query->execute([
        "name" => $name,
        "position" => $position,
        "salary" => $salary
    ]);

    if ($result) {
        header("Location: index.php?added=1");
        exit();
    } else {
        $message = "<div class='alert error'>Помилка додавання працівника.</div>";
    }
}

echo "
<body>
    <h1>Додати нового працівника</h1>
    
    $message
    
        <form method='post' action='insert.php'>
                <label for='name'>Ім'я працівника:</label>
                <input type='text' name='name' required>
                <br>
                <label for='position'>Посада:</label>
                <input type='text' name='position' required>
                <br>
                <label for='salary'>Заробітна плата (грн):</label>
                <input type='number' name='salary' step='0.01' min='0' required>
                <br>
                <button type='submit' class='btn btn-success'>Додати</button>
                <a href='index.php'><button type='button' class='btn btn-default'>Назад</button></a>
        </form>
    </div>
</body>
";