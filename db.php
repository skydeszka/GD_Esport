<?php
$configs = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
$dbconf = $configs['database'];

$host = $dbconf['host'];
$db = $dbconf['database'];
$user = $dbconf['username'];
$password = $dbconf['password'];

$dns = "mysql:host=$host;dbname=$db;charset=UTF8";

$pdo = new PDO($dns, $user, $password);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

if (!$pdo) 
    throw new Exception("Couldn't start PDO");

return $pdo;
?>