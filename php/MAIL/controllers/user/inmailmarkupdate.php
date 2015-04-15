<?php
include '../../db/config.php';

$user_id = $_SESSION['id'];
$mail_id = $_POST['mail_id'];
$date = date("Y-m-d H:i:s");

$r = mysql_fetch_assoc(mysql_query(
				"select *
				 from Recipients
				 where
				 mail_id = '$mail_id' and
				 user_id = '$user_id'"));

$mark_state_id = $r['mark_state_id'] == 2 ? 1 : 2;
mysql_query("update Recipients set
		mark_state_id='$mark_state_id',
		updated_at='$date'
	     where
		mail_id='$mail_id' and
		user_id='" . $user_id . "'");

$_SESSION['success'] = "Mail onayı işlemi başarılı";
header("Location: " . $PATH . "/user/index.php?yield=inmail&id=$mail_id");
?>
