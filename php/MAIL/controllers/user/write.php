<?php
include '../../db/config.php';

$recipient_emails = $_POST['recipient_emails'];
$subject = $_POST['subject'];
$content = $_POST['content'];
$files = isset($_FILES['files']) ? $_FILES['files'] : null;
$date = date("Y-m-d H:i:s");
$id = $_SESSION['id'];

mysql_query("insert into Mails
		(user_id, subject, content, created_at, updated_at)
	     values ('$id', '$subject', '$content', '$date', '$date')");

$mail_id = mysql_insert_id();

foreach ($recipient_emails as $recipient_email) {

	$recipient_user = mysql_fetch_assoc(mysql_query("select * from Users where email = '$recipient_email'"));
	$recipient_user_id = $recipient_user['id'];
	mysql_query("insert into Recipients
			(mail_id, user_id, mark_state_id, created_at, updated_at)
		    values ('$mail_id', '$recipient_user_id', 1, '$date', '$date')");
}

if (!is_null($files))
	for ($i = 0; $i < count($files); $i++)
		if ($files['name'][$i] != "") {
			$extension = pathinfo($files['name'][$i])['extension'];
			$file_name = $PATH . "/TEST/" . $mail_id . $i . "." . $extension;
			$dest = $_SERVER['DOCUMENT_ROOT'] . $file_name;
			move_uploaded_file($files['tmp_name'][$i], $dest);
			mysql_query("insert into Files
					(mail_id, name, created_at, updated_at)
			    values ('$mail_id', '$file_name', '$date', '$date')");
}

$_SESSION['success'] = "Mail gönderildi";
header('Location: ' . $PATH . '/user/index.php?yield=outmail&id=' . $mail_id);
?>
