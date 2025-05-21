<?php

include_once("database.php");

$message = "";
if(isset($_GET["deleted"]) && $_GET["deleted"] == 1) {
    $message = "<div class='alert success'>Працівника успішно видалено</div>";
} else if(isset($_GET["added"]) && $_GET["added"] == 1) {
    $message = "<div class='alert success'>Працівника успішно додано</div>";
} else if(isset($_GET["updated"]) && $_GET["updated"] == 1) {
    $message = "<div class='alert success'>Дані працівника успішно оновлено</div>";
}

$sql = "SELECT * FROM employees";
$result = pdo()->query($sql);

echo "
    <h1>Список працівників</h1>
    
    $message
    
    <a href='insert.php'><button>Додати працівника</button></a>
    <a href='statistics.php'><button>Статистика</button></a>
    
    <table class='employee-table'>
        <tr>
            <th>ID</th>
            <th>Ім'я</th>
            <th>Посада</th>
            <th>Заробітна плата</th>
            <th>Дії</th>
        </tr>";

foreach($result as $row) {
    echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['position']."</td>
            <td>".$row['salary']." грн</td>
            <td class='actions'>
                <a href='edit.php?id=".$row['id']."'><button>Редагувати</button></a>
                <form method='post' action='delete.php' style='display: inline;' onsubmit='return confirm(\"Ви впевнені, що хочете видалити цього працівника?\");'>
                    <input type='hidden' name='id' value='".$row['id']."'>
                    <button type='submit'>Видалити</button>
                </form>
            </td>
          </tr>";
}

echo "
    </table>
";