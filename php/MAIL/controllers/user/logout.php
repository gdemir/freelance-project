<?php
include '../../db/config.php';

session_destroy();
header('Location: ' . $PATH . "/user/login.php?yield=login");
?>
