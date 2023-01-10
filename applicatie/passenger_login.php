<?php
require_once 'components/headerFooter.php';
session_start();
$_SESSION['loggedInAsPassenger'] = false;
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

        <div class="textbox">

        <h2>
          Login
        </h2>

        <form  action="passenger_home_page.php" method="post">
          <div class = "flex-container">
            <div class = "indiv-flex">
              <input type = "number" placeholder="passagiersnummer" class = "inputtextbox" name = "passenger_number" required>
            </div>

            <div class = "indiv-flex">
              <input type = "text" placeholder="naam" class = "inputtextbox" name = "name" required>
            </div>

        
            </div>
          <button class = "inputtextbox" type = "submit">submit</button>
        </form>
      </div>
      


    </main>



    <?php echo getFooter(); ?>

  </body>
</html>