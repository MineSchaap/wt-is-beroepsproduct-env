<?php
session_start();
require_once 'db_connectie.php';
require_once 'components/headerFooter.php';

// maak verbinding met de database (zie db_connection.php)
//many warnings when the db doesn't return anything
$db = maakVerbinding();

if(isset($_POST['vluchtnummer'])){
    $vluchtnummer = $_POST['vluchtnummer'];
}
else{
    echo '<h1> geen vluchtnummer gegeven</h1>';
    return;
}

$sql = 'select luchthaven.naam AS luchthaven_naam, Maatschappij.maatschappijcode as maatschappij_maatschappijcode, maatschappij.naam as maatschappij_naam, vluchtnummer, gatecode, vertrektijd, (select max_aantal from Vlucht where vluchtnummer='.$vluchtnummer.') - (select count(*) from Passagier where vluchtnummer='.$vluchtnummer.') as plaatsen_over
from Vlucht, luchthaven, Maatschappij
where Luchthaven.luchthavencode = Vlucht.bestemming
and vlucht.maatschappijcode = Maatschappij.maatschappijcode
and vluchtnummer = ' . $vluchtnummer;//sql query


$data = $db->query($sql);
$rij = $data->fetch();

if(!isset($rij))return;

if(empty($rij)){ 
  echo '<h1> geen geldig vluchtnummer </h1>'; 
  return;
}

$bestemming = 'naar ' . $rij['luchthaven_naam'];
$maatschappij = $rij['maatschappij_naam'] . ', ' . $rij ['maatschappij_maatschappijcode'];
$vertrektijd = $rij['vertrektijd'];
$datum = date_format(date_create($vertrektijd),"Y-m-d");
$tijd = date_format(date_create($vertrektijd),"H:i");
$gateCode = 'gate  ' . $rij['gatecode'];
$plaatsenOver = 'Nog ' . $rij['plaatsen_over'] . ' plaatsen over';
?>

<!DOCTYPE html>
<html lang="nl">
  <head>
    
    <link rel="stylesheet" href="css/mijncss.css">

    <meta charset="utf-8">
    <title>gelre airport medewerker page</title>
  </head>
  <body>
    <?php echo getHeader(); ?>

    <main>
      <div class = "companyNameUnderHeader">
        <h1>
          Gelre Airport
        </h1>
      </div>


      <div class = "vlucht-details-box">
            <h2>
                <?= $bestemming ?>
            </h2>

            <p>
                <?= $maatschappij ?>
            </p>

            <p>
            <?= $datum ?>
            </p>
            <p>
            <?= $tijd ?>
            </p>

            <p>
                Op schema
            </p>

            <p>
                <?= $gateCode ?>
            </p>

            <p>
                <?= $plaatsenOver ?>
            </p>
        </div>

    </main>



    <?php echo getFooter(); ?>

  </body>
</html>