<?php
include '../../db/config.php';

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$user_type_id = $_POST['user_type_id'];
$department_id = $_POST['department_id'];
$gender_id = $_POST['gender_id'];
$date = date("Y-m-d H:i:s");

mysql_query("update Users set
		first_name='$first_name',
		last_name='$last_name',
		email='$email',
		password='$password',
		user_type_id='$user_type_id',
		department_id='$department_id',
		gender_id='$gender_id',
		updated_at='$date'
	     where id='$id'");

$_SESSION['success'] = "Kullanıcı güncellendi";
header('Location: ' . $PATH . '/admin/index.php?yield=usershow&id=' . $id);
?>
