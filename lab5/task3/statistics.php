<?php

include_once("database.php");

$total_query = pdo()->query("SELECT COUNT(*) as total FROM employees");
$total_employees = $total_query->fetch()["total"];

$avg_query = pdo()->query("SELECT AVG(salary) as avg_salary FROM employees");
$avg_salary = round($avg_query->fetch()["avg_salary"], 2);

$max_query = pdo()->query("SELECT MAX(salary) as max_salary FROM employees");
$max_salary = $max_query->fetch()["max_salary"];

$min_query = pdo()->query("SELECT MIN(salary) as min_salary FROM employees");
$min_salary = $min_query->fetch()["min_salary"];

$positions_query = pdo()->query("SELECT position, COUNT(*) as count FROM employees GROUP BY position ORDER BY count DESC");
$positions = $positions_query->fetchAll();

echo "
<h1>Статистика працівників</h1>
    
<h3>Загальна кількість працівників</h3>
<span class='value'>$total_employees</span>
        
<h3>Середня зарплата</h3>
<div class='value'>$avg_salary грн</div>

<h3>Найвища зарплата</h3>
<span$max_salary грн</span>

<h3>Найнижча зарплата</h3>
<span>$min_salary грн</span>
<h2>Кількість працівників за посадами</h2>
<table class='positions-table'>
    <tr>
        <th>Посада</th>
        <th>Кількість працівників</th>
    </tr>";

foreach ($positions as $position) {
    echo "<tr>
            <td>".$position['position']."</td>
            <td>".$position['count']."</td>
          </tr>";
}

echo "
    </table>
    
    <a href='index.php' class='btn'>Повернутися до списку</a>
";