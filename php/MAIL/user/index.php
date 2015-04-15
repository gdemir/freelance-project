<?php
include '../db/config.php';

if (isset($_SESSION['user']))
	require '../views/layouts/user_layout.html';
else {
	$_SESSION['warning'] = "Lütfen hesabınıza giriş yapın!";
	header('Location: ' . $PATH . '/user/login.php?yield=login');
}
?>
