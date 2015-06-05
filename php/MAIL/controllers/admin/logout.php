<?php
include '../../db/config.php';

session_destroy();
header('Location: ' . $PATH . '/admin/login.php?yield=login');
?>
