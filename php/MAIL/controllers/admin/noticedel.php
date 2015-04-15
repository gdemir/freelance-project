<?php
include '../../db/config.php';

$id = $_POST['id'];

mysql_query("delete from Notices where id='$id'");

$_SESSION['info'] = "Duyuru silindi";
header('Location: ' . $PATH . '/admin/index.php?yield=notices');
?>
