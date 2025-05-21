<?php

include_once("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $query = pdo()->prepare("DELETE FROM employees WHERE id = :id");
    $result = $query->execute(["id" => $id]);

    if ($result && $query->rowCount() > 0) {
        header("Location: index.php?deleted=1");
    } else {
        header("Location: index.php?deleted=0");
    }
} else {
    header("Location: index.php");
}