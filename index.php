<?php
 
	if(!isset($_SESSION['email'])) {
		header('Location: login.php');
	}
	else {
		header('Location: dashboard.php');
	}

?>