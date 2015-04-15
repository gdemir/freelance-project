<?php
include '../../db/config.php';

$id = $_POST['id'];

mysql_query("delete from Users where id='$id'");
mysql_query("delete from Mails where user_id='$id'");
mysql_query("delete from Recipients where user_id='$id'");
mysql_query("delete from Notices where user_id='$id'");

$_SESSION['info'] = "Kullanıcı silindi";
header('Location: ' . $PATH . '/admin/index.php?yield=users');
?>
