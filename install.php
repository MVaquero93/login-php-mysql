<?php
	
$servername = "localhost";
$username = "root";
$password = "";
$database = "login_example";

$sql = file_get_contents('db.sql');

try {
	$conn = new PDO("mysql:host=$servername;charset=utf8", $username, $password);
	$conn -> exec($sql);
}
catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
	die('Error instalando la base de datos.');
}		

header('Location: login.php');	 

?>