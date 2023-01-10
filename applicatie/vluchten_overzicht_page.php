<?php
require_once 'db_connectie.php';
require_once 'components/headerFooter.php';
require_once 'components/individualFlightField.php';

session_start();

// maak verbinding met de database (zie db_connection.php)
$db = maakVerbinding();

$sql = chooseQuery();

$data = $db->query($sql);


$vluchten = '';

//while($rij = $data->fetch()) {
foreach($data as $rij){
    $id = $rij['vluchtnummer'];
    $bestemming = $rij['naam'];
    $vertrektijd = $rij['vertrektijd'];
    
    $vluchten .= makeIndividualFlightBox($id, $bestemming, $vertrektijd);
}

function chooseQuery(){//build a query based on sorting methods specified in header

    $query = 'select vluchtnummer, naam, vertrektijd
    from Vlucht, Luchthaven
    where Luchthaven.luchthavencode = Vlucht.bestemming
    ';

    //check if you should show the flights for a passenger or worker
    if(!isset($_SESSION['loggedInAsMedewerker']) || !$_SESSION['loggedInAsMedewerker']){
        $query .= 'and getDate() < vertrektijd '; //add a space or a white space or part of the query will be: and getDate() < vertrektijdorder by naam
    }

    if(!isset($_GET['sort']) || $_GET['sort'] == "date0"){
        $query .= 'order by vertrektijd asc';
    }
    elseif($_GET['sort'] == "date1"){
        $query .= 'order by vertrektijd desc';
    }
    elseif($_GET['sort'] == "luchthaven0"){
        $query .= 'order by naam asc, vertrektijd asc';
    }
    elseif($_GET['sort'] == "luchthaven1"){
        $query .= 'order by naam desc, vertrektijd asc';
    }
    else{
        $query .= 'order by vertrektijd asc';
    }

    return $query;
}


?>

<!DOCTYPE html>
<html lang="nl">
  <head>
    
    <link rel="stylesheet" href="css/mijncss.css">

    <meta charset="utf-8">
    <title>gelre airport vluchten overzicht</title>
  </head>
  <body>
    <?php echo getHeader(); ?>

    <main>

        <div class = "companyNameUnderHeader">
            <h1>
                Gelre Airport
            </h1>
        </div>

        <div class = "flightsorting">

            <label>sorteer op:</label>
            <form action = "vluchten_overzicht_page.php">
                <select id="sort" name="sort">
        
                    <option value="date0" selected="selected">vertrektijd, snelste eerst</option>
            
                    <option value="date1">vertrektijd, laatste eerst</option>
            
                    <option value="luchthaven0">luchthaven, oplopend</option>
            
                    <option value="luchthaven1">luchthaven, aflopend</option>
            
                </select>

                <input type="submit" value="Submit">
            </form>
        </div>

        <div class = "textbox">
            <h2>
                vluchten
            </h2>

            <?= $vluchten ?>
   
        </div>

    </main>



    <?php echo getFooter(); ?>

  </body>
</html>