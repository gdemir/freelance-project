<?php
include '../../db/config.php';

if (isset($_SESSION['admin']))
	header('Location: ' . '/admin/index.php');

$email = $_POST['email'];
$password = $_POST['password'];

$record = mysql_fetch_assoc(mysql_query("select * from Users where email = '$email' and password = '$password' and user_type_id = 1"));
if ($record) {

	session_destroy();
	session_start();

	$_SESSION['admin'] = true;
	$_SESSION['fullname'] = $record['first_name'] . " " . $record['last_name'];
	$_SESSION['id'] = $record['id'];

	header('Location: ' . $PATH . '/admin/index.php');
} else {
	$_SESSION['danger'] = "Oops! İsminiz veya şifreniz hatalı, belkide bunlardan sadece biri hatalıdır?";
	header('Location: ' . $PATH . '/admin/index.php?yield=login');
}
?>
