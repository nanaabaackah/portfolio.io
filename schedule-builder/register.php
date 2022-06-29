<?php
$fullname = $_POST['fullname'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['pword'] ?? "";

session_start();

require "includes/library.php";

$pdo = connectDB();

$query = "insert into website_users values (NULL, NULL,?,?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$fullname, $email, $password]);

header("Location:index.html");
exit();
?>