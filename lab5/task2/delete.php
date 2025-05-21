<?php

include_once("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $query = pdo()->prepare("DELETE FROM tov WHERE id = :id");
    $result = $query->execute(["id" => $id]);
}

header("Location: index.php");
