<?php
function security($posts) {
	foreach ($posts as $key => $value)
		if ($key != "recipient_emails" and $key != "documents")
			$posts[$key] = mysql_real_escape_string($value);
	return $posts;
}
function connect($_host, $_user, $_pass, $_name) {
	if (!($connector = mysql_connect($_host, $_user, $_pass)))
		die("error : db user or password is wrong<br/>");
	if (!mysql_select_db($_name, $connector))
		die("error : dbname is wrong<br/>");
	mysql_query('set names "utf8"');
	mysql_query('set character set "utf8"'); // dil secenekleri
	mysql_query('set collation_connection = "utf8_general_ci"');
	mysql_query('set collation-server = "utf8_general_ci"');
}

function clear_notice_session() {
	$keys = array('danger', 'warning', 'success', 'info');
	foreach ($keys as $key)
		unset($_SESSION[$key]);
}
$PATH = "/MAIL";
connect('localhost', 'root', '123456', 'MAIL');

if (isset($_POST))
	$_POST = security($_POST);

if (!strlen(session_id()))
	session_start();
?>
