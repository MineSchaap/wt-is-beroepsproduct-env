<?php
session_start();
$_SESSION['loggedInAsMedewerker'] = true;

header('Location:' . '/medewerker_home_page.php');
?>