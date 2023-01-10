<?php
function passengerBaggageTooHeavy($db, $passengerNumber, $weight){

    $sql = "select max_gewicht_pp, (select isnull(sum(gewicht), 0)
	from BagageObject
	where passagiernummer = :passagiernummer1) as huidigGewicht
    from vlucht
    where vluchtnummer = (select vluchtnummer from passagier where passagiernummer = :passagiernummer2)";

    $query = $db->prepare($sql);
    $query->execute(['passagiernummer1' => $passengerNumber, 'passagiernummer2' => $passengerNumber]);

    $row = $query->fetch();
    

    if($row['huidigGewicht'] + $weight > $row['max_gewicht_pp']) return true;

    /*else*/return false;
}

function insertNewBagage($db, $passengerNumber, $weight){
    $sql = "insert into BagageObject(passagiernummer, objectvolgnummer, gewicht)
    values(
	:passengerNumber,
	(select ISNULL(max(objectvolgnummer) + 1, 0)--makes use of: null + int = null
	from BagageObject
	where passagiernummer = :numberPassenger),
	:weight);";

    $query = $db->prepare($sql);
    $query->execute([':weight' => $weight, ':passengerNumber' => $passengerNumber, ':numberPassenger' => $passengerNumber]);
}
?>