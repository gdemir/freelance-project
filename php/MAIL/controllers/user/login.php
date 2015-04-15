<?php
include '../../db/config.php';

if (isset($_SESSION['user']))
	header('Location: ' . $PATH . '/user/index.php');

$email = $_POST['email'];
$password = $_POST['password'];

$record = mysql_fetch_assoc(mysql_query("select * from Users where email = '$email' and password = '$password'"));
if ($record) {

	session_destroy();
	session_start();

	$_SESSION['user'] = true;
	if ($record['user_type_id'] != 3) // Öğrenci değilse süper
		$_SESSION['superuser'] = true;

	$_SESSION['fullname'] = $record['first_name'] . " " . $record['last_name'];
	$_SESSION['id'] = $record['id'];

	header('Location: ' . $PATH . '/user/index.php');
} else {
	$_SESSION['danger'] = "Oops! İsminiz veya şifreniz hatalı, belkide bunlardan sadece biri hatalıdır?";
	header('Location: ' . $PATH . '/user/index.php?yield=login');
}
?>
