<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db_connectie.php';
session_start();

if(!isset($_SESSION['loggedInAsMedewerker']) || !$_SESSION['loggedInAsMedewerker']){
    return;
}
$db = maakVerbinding();


$destination = $_POST['destination'];
$gate_code = $_POST['gate_code'];
$max_amount = $_POST['max_amount'];
$max_weight = $_POST['max_weight'];
$departure_time = date_format(date_create($_POST['departure_time']), 'Y-m-d H:i');
$maatschappij = $_POST['maatschappij'];
$destination = $_POST['destination'];

$sql = "insert into Vlucht(vluchtnummer, bestemming, gatecode, max_aantal, max_totaalgewicht, max_gewicht_pp, vertrektijd, maatschappijcode)
values(
	(select max(vluchtnummer) + 1
	from vlucht),
	(select luchthavencode
	from Luchthaven
	where naam = :destination),
	:gate_code,
	:max_amount,
	:max_weight,
	cast( :max_amount2 as numeric(5,2)) / cast( :max_weight2 as numeric(5,2)),
	:departure_time,
	(select maatschappijcode
	from Maatschappij
	where naam = :maatschappij)
	);";


$query = $db->prepare($sql);
$query->execute([':destination' => $destination, ':gate_code' => $gate_code, ':max_amount' => $max_amount, ':max_weight' => $max_weight, ':departure_time' => $departure_time, ':maatschappij' => $maatschappij, ':max_amount2' => $max_amount, ':max_weight2' => $max_weight]);

header('Location: /medewerker_home_page.php');
?>