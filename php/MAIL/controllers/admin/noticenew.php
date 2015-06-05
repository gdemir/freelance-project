<?php
include '../../db/config.php';

$id   = $_SESSION['id'];
$name = $_POST['name'];
$date = date("Y-m-d H:i:s");

mysql_query("insert into Notices
		(user_id, name, created_at, updated_at)
	    values('$id', '$name', '$date', '$date')");

$notice_id = mysql_insert_id();

$_SESSION['success'] = "Yeni kayıt oluşturuldu";
header('Location: ' . $PATH . "/admin/index.php?yield=noticeshow&id=$notice_id");
?>
