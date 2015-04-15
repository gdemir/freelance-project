<?php
include '../../db/config.php';

$id = $_POST['id'];
$name = $_POST['name'];
$date = date("Y-m-d H:i:s");

mysql_query("update Notices set
		name='$name',
		updated_at='$date'
	     where id='$id'");

$_SESSION['success'] = "Duyuru güncellendi";
header('Location: ' . $PATH . '/admin/index.php?yield=notice&id=' . $id);
?>
