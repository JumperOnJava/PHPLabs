<?php

include_once("database.php");

$sql = "SELECT * FROM tov";
$result = pdo()->query($sql);

echo "
    <h1>Список товарів</h1>
    
    <a href='insert.php'><button>Додати запис</button></a><br><br>
    <form action='delete.php' method='post' style='display: inline;'>
        <input type='number' name='id' placeholder='Вилучити запис №х'>
        <input type='submit' value='Вилучити'>
    </form>
    <br>
    <table class='product-table'>
        <tr>
            <th>Номер</th>
            <th>Назва</th>
            <th>Вартість</th>
            <th>Кількість</th>
            <th>Дата</th>
        </tr>";

foreach($result as $row) {
    echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['cost']."</td>
            <td>".$row['amount']."</td>
            <td>".$row['date']."</td>
          </tr>";
}

echo "
    </table>
";