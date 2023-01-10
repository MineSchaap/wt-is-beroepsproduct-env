<?php
require_once 'components/headerFooter.php';
session_start();
$_SESSION['loggedInAsMedewerker'] = false;
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

        <form  action="components/handleMedewerkerLogin.php" method="post">
          <button class = "inputtextbox" type = "submit">submit</button>
        </form>
      </div>
      


    </main>



    <?php echo getFooter(); ?>

  </body>
</html>