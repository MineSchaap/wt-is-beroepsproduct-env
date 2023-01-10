<?php
require_once 'components/headerFooter.php';
require_once 'components/flightSearch.php';
?>
<!DOCTYPE html>
<html lang="nl">
  <head>
    
    <link rel="stylesheet" href="css/mijncss.css">

    <meta charset="utf-8">
    <title>gelre airbrot landing</title>
  </head>
  <body>
    <?php echo getHeader(); ?>

    <main>
        <div class = "animation">
        <div class = "companyNameUnderHeader">
            <h1>
                Gelre Airport
            </h1>

        </div>
        </div>


        <div  class = "grid-buttons">
            <a  href = "passenger_login.php" class = "individual-grid-button">
                log in als passagier
            </a>

            <a  href = "medewerker_login.php" class = "individual-grid-button">
                log in als medewerker
            </a>
        </div>
      
      <?php
      echo getFlightSearchBox();
      ?>

    </main>



    <?php echo getFooter(); ?>

  </body>
</html>