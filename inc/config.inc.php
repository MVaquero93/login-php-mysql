<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "login_example";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
}
catch(PDOException $e){
    //echo "Connection failed: " . $e->getMessage();
	if($e->getCode() == 1049) die('Es necesario instalar la base de datos, ejecuta <a href="install.php">install.php</a>');
}