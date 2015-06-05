<?php
include '../db/config.php';

if (isset($_SESSION['admin']))
	require '../views/layouts/admin_layout.html';
else {
	$_SESSION['warning'] = "Lütfen hesabınıza giriş yapın!";
	header('Location: ' . $PATH . '/admin/login.php?yield=login');
}
?>
