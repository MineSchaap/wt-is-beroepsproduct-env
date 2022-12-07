<?php
$naam = $_GET['omschrijving'];
$datum = $_GET['datum'];
$current_datum = date('d-m-y');
echo $naam . " " . date_diff($datum,$current_datum, true);


?>