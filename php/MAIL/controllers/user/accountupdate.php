<?php
include '../../db/config.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$password = $_POST['password'];
$date = date("Y-m-d H:i:s");
$id = $_SESSION['id'];

mysql_query("update Users set
		first_name='$first_name',
		last_name='$last_name',
		password='$password',
		updated_at='$date'
	     where id='$id'");

$_SESSION['fullname'] = $first_name . " " . $last_name;
$_SESSION['success'] = "Kayıt başarılı";
header('Location: ' . $PATH . '/user/index.php?yield=accountshow');
?>
