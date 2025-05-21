<?php

$host = '127.0.0.1';
$db = 'lab5';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

//chatgpt code
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,          // Throw exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,     // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES => false,                  // Use real prepared statements
];


$pdo = new PDO($dsn, $user, $pass, $options);

function pdo(): PDO
{
    global $pdo;
    return $pdo;
}

function generateRandomString($length = 10) {
    // https://stackoverflow.com/a/13212994
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}