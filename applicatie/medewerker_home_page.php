<?php
require_once 'components/headerFooter.php';
require_once 'components/flightSearch.php';
require_once 'db_connectie.php';

session_start();

if(!isset($_SESSION['loggedInAsMedewerker']) || !$_SESSION['loggedInAsMedewerker']){
  header('location: medewerker_login.php');
}

if(true){//om de check of de inloggegevens kloppen te simuleren. medewerker krijgen meestal een wachtwoord en gebruikersnaam, ik heb alleen een knop.
  $_SESSION['loggedInAsMedewerker'] = true;
}

function choices($sql){
  $htmlString = '';

  $db = maakVerbinding();

  $data = $db->query($sql);


//while($rij = $data->fetch()) {
  foreach($data as $rij){
    //<option value = "test">test</option>
    $htmlString .= '<option value = "' . $rij['naam'] . '">' .  $rij['naam'] . '</option>';
  } 
  return $htmlString;
}
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
      
        <div class = "grid-buttons">
          <a href = "vluchten_overzicht_page.php" class = "individual-grid-button">
            naar vluchtenoverzicht
          </a>
        </div>

      <div class="textbox">

        <!--
          bagage inchecken
          pasagiernummer, objectvolgnummer
          de passagier weegt thuis, een medewerker controleertd gegevens:
          vult in passagiernummer en volgnummer en krijgt het gewicht en of het bestaat

        -->

        <h2>
          bagage inchecken
        </h2>

        <form  action="components/handleMedewerkerNewBaggage.php" method="post">
          <div class = "flex-container">
            <div class = "indiv-flex">
              <input type = "number" placeholder="passagiersnummer" class = "inputtextbox" name = "passenger_number" required>
            </div>

            <div class = "indiv-flex">
              <input type = "number" placeholder="aantal kilogram" class = "inputtextbox" step = 0.01 name = "weight" required>
            </div>
        
            </div>
          <button class = "inputtextbox">check koffer in</button>
        </form>
      </div>

      <?php
      echo getFlightSearchBox();
      ?>



      <div class = "textbox"><!--nieuwe vlucht invoeren-->

        <!--
           bestemming, vertrektijd, gatecode, max aantal, max gewicht pp      
        -->
        <h2>
          Voer een nieuwe vlucht in
        </h2>

        <form action="components/handleNewFlight.php" method="post">
          <div class = "flex-container">
            <div class = "indiv-flex">

              <label for="destination">bestemming:</label>
              <select class = "inputtextbox" name = "destination" id = "destination" required>
                <?php echo choices('select naam from Luchthaven'); ?>
              </select>
            </div>
            <div class = "indiv-flex">
              <label for="gate_code">gate nummer:</label>
              <select class = "inputtextbox" name = "gate_code" id = "gate_code" required>
                <?php echo choices('select gatecode as naam from gate'); ?>
              </select>
            </div>       
          </div>

        <div class = "flex-container">
          <div class = "indiv-flex">
            <label for="max_amount">aantal passagiers:</label>
            <input type = "number" placeholder="max aantal" class = "inputtextbox" name = "max_amount" required>
          </div>

          <div class = "indiv-flex">
            <label for="max_weight">totaal gewicht:</label>
            <input type = "number" placeholder="max gewicht" class = "inputtextbox" name = "max_weight" required>
          </div>       
        </div>

        <div class = "flex-container">
          <div class = "indiv-flex">
            <label for="vertrektijd">vertrektijd:</label>
            <input type="datetime-local" id="vertrektijd" name="departure_time" class = "inputtextbox" required>
          </div>

          <div class = "indiv-flex">
            <label for="maatschappijcode">maatschappij:</label>
            <select id= "maatschappij" name = "maatschappij" class = "inputtextbox" required>
              <?php echo choices('select naam from Maatschappij'); ?>
            </select>
          </div>       
        </div>

        <button class = "inputtextbox">submit</button>
      </form>

    </div>






      <div class = "textbox"><!--nieuwe passagier -->

        <!--
          naam, vlucht, geslacht
        -->
        <h2>
          Voer een nieuwe passagier in
        </h2>

        <form action="components/handleNewPassenger.php" method="post">
          <div class = "flex-container">
            <div class = "indiv-flex">
              <input type = "text" placeholder="naam" name= "naam" class = "inputtextbox" required>
            </div>

            <div class = "indiv-flex">
              <input type = "number" placeholder="vluchtnummer" name = "vluchtnummer" class = "inputtextbox" required>
            </div>
          </div>

          <div class = "flex-container">
            <div class = "indiv-flex">
              <input type = "text" placeholder="stoel" name= "stoelcode" class = "inputtextbox" required>
            </div>

            <div class = "indiv-flex">
              <select id="geslacht" name="geslacht" class = "inputtextbox">
                <option value="M">man</option>
                <option value="V">vrouw</option>
                <option value="x">anders</option>
              </select>
            </div>
          </div>

          <button class = "inputtextbox">submit</button>
        </form>
      </div>

    </main>



    <?php echo getFooter(); ?>

  </body>
</html>