<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db_connectie.php';

session_start();

if(!isset($_SESSION['loggedInAsMedewerker']) || !$_SESSION['loggedInAsMedewerker']){
    return;
}

$db = maakVerbinding();

$naam = $_POST['naam']; 
$vluchtnummer = $_POST['vluchtnummer'];
$geslacht = $_POST['geslacht'];
$stoelcode = $_POST['stoelcode'];

if(strlen($stoelcode) > 3){
    echo '<h1> stoelcode te lang </h1>';
    return;
}


if(!flightExists($db, $vluchtnummer)){
    echo '<h1> vluchtnummer bestaat niet </h1>';
    return;
}

if(tooManyPassengers($db, $vluchtnummer)){
    echo '<h1> teveel passagiers </h1>';
    return;
}

if(seatIsTaken($db, $stoelcode, $vluchtnummer)){
    echo '<h1> stoel is al bezet </h1>';
    return;
}


$sql = "
SET ANSI_WARNINGS OFF;
insert into passagier(passagiernummer, naam, vluchtnummer, geslacht, stoel)
values(
(select max(passagiernummer) from Passagier) + 1,
:naam, :vluchtnummer, :geslacht, :stoel);";


$query = $db->prepare($sql);
$query->execute([':naam' => $naam, ':vluchtnummer' => $vluchtnummer, ':geslacht' => $geslacht, ':stoel' => $stoelcode]);

header('Location: /medewerker_home_page.php');


function tooManyPassengers($db, $vluchtnummer){//bool
    $sql = "select (select count(*) from Passagier where vluchtnummer= :vluchtnummer1) as passenger_amount, max_aantal
    from vlucht
    where vluchtnummer= :vluchtnummer2";


    $query = $db->prepare($sql);
    $query->execute([':vluchtnummer1' => $vluchtnummer, ':vluchtnummer2' => $vluchtnummer]);


    $row = $query->fetch();

    $totalPassengers = $row['passenger_amount'];
    $maxPassengers = $row['max_aantal'];

    //is er ruimte voor een extra passagier
    if($totalPassengers >= $maxPassengers){
        return true;
    }
    return false;
}

function seatIsTaken($db, $stoelcode, $vluchtnummer){
    $sql = "select count(*) as amount 
    from Passagier 
    where stoel = :stoel
    and vluchtnummer = :vluchtnummer";


    $query = $db->prepare($sql);
    $query->execute([':stoel' => $stoelcode, ':vluchtnummer' => $vluchtnummer]);


    $row = $query->fetch();

    if($row['amount'] >= 1) return true;
    /*else*/return false;
}

function flightExists($db, $vluchtnummer){
    $sql = "select count(*) as amount 
    from vlucht
    where vluchtnummer = :vluchtnummer";


    $query = $db->prepare($sql);
    $query->execute([':vluchtnummer' => $vluchtnummer]);


    $row = $query->fetch();

    if($row['amount'] == 0) return false;
    return true;
}
?>