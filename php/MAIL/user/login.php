<?php
include '../db/config.php';

if (isset($_SESSION['user']))
	header('Location: ' . $PATH . '/user/index.php');

require '../views/layouts/default_layout.html';
?>
