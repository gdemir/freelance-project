<?php
include '../../db/config.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$user_type_id = $_POST['user_type_id'];
$department_id = $_POST['department_id'];
$gender_id = $_POST['gender_id'];
$date = date("Y-m-d H:i:s");

$record = mysql_fetch_assoc(mysql_query("select * from Users where email = '$email'"));
if ($record) {
	$_SESSION['danger'] = "$email zaten kayıtlı!";
	$_SESSION['warning'] = "Lütfen başka bir email adresi ile kayıt olun";
	header('Location: ' . $PATH . "/admin/index.php?yield=usernew");
	return;
}
mysql_query("insert into Users
		(first_name, last_name, email, password, user_type_id,
		department_id, gender_id, created_at, updated_at)
	    values('$first_name', '$last_name', '$email', '$password',
		'$user_type_id', '$department_id', '$gender_id', '$date', '$date')");

$user_id = mysql_insert_id();

$_SESSION['success'] = "$email adresine ait yeni kayıt oluşturuldu";
header('Location: ' . $PATH . "/admin/index.php?yield=usershow&id=$user_id");
?>
