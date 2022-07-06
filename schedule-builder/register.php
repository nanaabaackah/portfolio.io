<?php
$fullname = $_POST['fullname'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['pword'] ?? "";

session_start();

$host = 'localhost';
$username= 'root';
$password='';
$dbName = 'scheduling_website';
$charset = 'utf8mb4';

$con = mysqli_connect($host, $user, $password, $database);
//If the connection fails, print out the error.
if(mysqli_connect_errno($con)){

	echo "Failed to connect to MySQL:".mysqli_connect_errno($con);
	}
	else{
/*Otherwise, print out that it was a successful connection.	
<h1> and <center> are HTML elements, however, this is not an HTML course we are just learning how to manipulate data.
HTML is the Hypertext Markup Language	
*/	
	echo "<center><h1>Successful Connection</h1></center>";
	}

mysqli_close($con);
/*require "includes/library.php";

$pdo = connectDB();

$query = "insert into website_users values (NULL, NULL,?,?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$fullname, $email, $password]);

header("Location:index.html");
exit();*/
?>