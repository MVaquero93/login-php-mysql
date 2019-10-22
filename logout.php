<?php
session_start();

$_SESSION['user_id'] = '';
$_SESSION['email'] = '';
$_SESSION['name'] = '';

session_destroy();

header("Location: login.php");
