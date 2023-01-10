<?php
session_start();
require_once 'db_connectie.php';
require_once 'components/individualFlightField.php';
require_once 'components/headerFooter.php';

if(!isIngelogdAsPassenger()){
    return;
}
else{
    $_SESSION['loggedInAsPassenger'] = true;
}

$flights = getFlightsHTML();

function getFlightsHTML(){
    // maak verbinding met de database (zie db_connection.php)
    $db = maakVerbinding();

    $sql = 'select vlucht.vluchtnummer, luchthaven.naam, vertrektijd, passagiernummer
    from Vlucht
	inner join luchthaven on  Luchthaven.luchthavencode = Vlucht.bestemming
	inner join passagier on passagier.vluchtnummer = vlucht.vluchtnummer
	where passagiernummer =' . $_SESSION['passenger_number'];

    $data = $db->query($sql);


    $vluchten = '<div class = "textbox">
    <h2>
        Mijn vluchten
    </h2>';

    //make the html from the query
    foreach($data as $rij){
        $id = $rij['vluchtnummer'];
        $bestemming = $rij['naam'];
        $vertrektijd = $rij['vertrektijd'];

        
        $vluchten .= makeIndividualFlightBox($id, $bestemming, $vertrektijd);
    }

    $vluchten .= '</div>';

    return $vluchten;
}

function isIngelogdAsPassenger(){
    if($_SESSION['loggedInAsPassenger']) return true;

    if(isset($_POST['passenger_number']) && isset($_POST['name'])){
        $_SESSION['passenger_number'] = $_POST['passenger_number'];
        $_SESSION['name'] = $_POST['name'];
    }
    elseif(!isset($_SESSION['passenger_number']) || !isset($_SESSION['name'])){
        header("Location: passenger_login.php");
        return;
    }
    else{
        header("Location: passenger_login.php");
        return;
    }

    $passenger_number = $_SESSION['passenger_number'];
    $name = $_SESSION['name'];

    // maak verbinding met de database (zie db_connection.php)
    $db = maakVerbinding();

    $sql = 
    'select count(*) as correctAmount
    from passagier
    where naam = \'' . $name . '\'
    and passagiernummer = '. $passenger_number . ';';

    $data = $db->query($sql);
    $rij = $data->fetch();


    $rowAmount = $rij['correctAmount'];

    if($rowAmount == 1){
        return true;
    }
    //else
    return false;
}

function getBagageHtml(){
    // maak verbinding met de database (zie db_connection.php)
    $db = maakVerbinding();
    $html = '';

    $sql = '
    select *
    from BagageObject
    where passagiernummer = ' . $_SESSION['passenger_number'] . '
    ';

    $data = $db->query($sql);

    $html .= '<div class = "textbox">
    <h2>
        mijn baggage
    </h2>';

    $html .= '<table>';
    $html .= '<tr><th>volgnummer</th><th>gewicht</th></tr>';

    foreach($data as $rij){
        $id = $rij['passagiernummer'];
        $volgnummer = $rij['objectvolgnummer'];
        $gewicht = $rij['gewicht'];
        
        $html .= '<tr><th>' . $volgnummer . '</th><th>'. $gewicht . 'kg' . '</th></tr>';
    }

    $html .= '</table> </div>';

    return $html;
}
?>

<!DOCTYPE html>
<html lang="nl">
  <head>
    
    <link rel="stylesheet" href="css/mijncss.css">

    <meta charset="utf-8">
    <title>gelre airport passenge page</title>
  </head>
  <body>
    <?php echo getHeader(); ?>

    <main>
        <div class = "companyNameUnderHeader">
            <h1>
              Gelre Airport
            </h1>
        </div>
        
            <?=$flights //html met alle vluchten die een passagier heeft?>

        <div class = "textbox">
            <h2>
                koffers inchecken
            </h2>

            <p>
                alstublieft uw koffers individueel inchecken
            </p>
            <form action="components/handlePassengerNewBaggage.php" method="post">
                <div class = "flex-container">
                    <div class = "indiv-flex">
                        <input type = "number" placeholder="hoeveelheid kilogram" class = "inputtextbox" name = "weight" step = 0.01 required>
                    </div>

                    <div class = "indiv-flex">
                        <button class = "inputtextbox" type = "submit">check koffer in</button>
                    </div>
            
                </div>
            <!--aangeven gewicht, aangeven passagiersnummer niet nodig => al ingelogd-->
            </form>
        </div>
        
        <?php echo getBagageHtml(); ?>

    </div>
    </main>



    <?php echo getFooter(); ?>

  </body>
</html>