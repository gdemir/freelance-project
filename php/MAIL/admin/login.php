<?php
include '../db/config.php';

if (isset($_SESSION['admin']))
	header('Location: ' . $PATH . '/admin/index.php');

require '../views/layouts/default_layout.html';
?>
