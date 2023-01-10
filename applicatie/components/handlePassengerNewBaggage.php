<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/db_connectie.php';
require_once 'handleNewBaggageChecks.php';

if(!isset($_SESSION['loggedInAsPassenger']) || !$_SESSION['loggedInAsPassenger']){
    return;
}

$db = maakVerbinding();
$weight = $_POST['weight'];
$passengerNumber = $_SESSION['passenger_number'];

if(passengerBaggageTooHeavy($db, $passengerNumber, $weight)){
	echo '<h1>bagage te zwaar</h1>';
	return;
}

insertNewBagage($db, $passengerNumber, $weight);

header('Location: /passenger_home_page.php');
?>