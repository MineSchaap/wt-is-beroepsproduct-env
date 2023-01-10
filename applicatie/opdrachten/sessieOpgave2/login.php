<?php
session_start();

$_SESSION['username'] = 'aronh';
$_SESSION['logged_in'] = true;

header("Location: homepage.php");
?>
