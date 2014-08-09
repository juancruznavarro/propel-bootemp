<?php
session_start();
$_SESSION['log'] = array();
unset($_SESSION['log']);

header('Location: index.php');exit();
?>
