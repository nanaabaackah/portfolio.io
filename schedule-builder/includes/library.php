<?php
$host = 'localhost';
$username= 'root';
$password='';
$dbName = 'scheduling_website';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE                   => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE        => PDO::FETCH_ASSOC,
    PDO::ATTR_EMMULATE_PREPARES         => FALSE,
];

try{
    $pdo = new PDO($dsn, $username, $password, $options);
} catch(\PDOException $e){
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>