<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/db_connectie.php';
require_once 'handleNewBaggageChecks.php';

if(!isset($_SESSION['loggedInAsMedewerker']) || !$_SESSION['loggedInAsMedewerker']){
    return;
}

$db = maakVerbinding();
$weight = $_POST['weight'];
$passengerNumber = $_POST['passenger_number'];

if(passengerBaggageTooHeavy($db, $passengerNumber, $weight)){
	echo '<h1>bagage te zwaar</h1>';
	return;
}

insertNewBagage($db, $passengerNumber, $weight);

header('Location: /medewerker_home_page.php');
?>
