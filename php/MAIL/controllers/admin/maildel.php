<?php
include '../../db/config.php';

$id = $_POST['id'];

mysql_query("delete from Mails where id='$id'");
mysql_query("delete from Recipients where mail_id='$id'");

$_SESSION['info'] = "Mail silindi";
header('Location: ' . $PATH . '/admin/index.php?yield=mails');
?>
