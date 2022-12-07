<?php
$omschrijving = $_GET['omschrijving'];
$datum = $_GET['datum'];

$vandaag = date_create('now');
$dag = date_create($datum);
$verschil = date_diff($vandaag, $dag);

$aantalDagen = $verschil->format('Het duurt nog %a dagen en %h uur tot ' . $omschrijving. '.');
?>

<!DOCTYPE html>
    <body>
        <h1>
            <?=$aantalDagen?>
        </h1>
    </body>
</htmml>