<?php
include '../../db/config.php';

$id = $_POST['id'];

$_document_result = mysql_query("select * from Documents where mail_id='$id'");
while ($document = mysql_fetch_assoc($_document_result))
	unlink($_SERVER["DOCUMENT_ROOT"] . $PATH . $document["url"]);

mysql_query("delete from Mails where id='$id'");
mysql_query("delete from Recipients where mail_id='$id'");
mysql_query("delete from Documents where mail_id='$id'");

$_SESSION['info'] = "Mail silindi";
header('Location: ' . $PATH . '/admin/index.php?yield=mails');
?>
