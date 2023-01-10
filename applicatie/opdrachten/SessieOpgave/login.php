<?php
session_start();

if(isset( $_POST['username'])) $_SESSION['username'] = $_POST['username'];

if (isset($_SESSION['username'])) {
  $html = "<h1>Welcome {$_SESSION['username']}</h1>";
  $logged_in = true;
}
else{
  $logged_in = false;
}
?>
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testsessie</title>
  </head>
  <body>
    <?php
    if ($logged_in) {
      echo $html;
    }
    ?>
    <!-- TODO: ongeldige waarde voor `action`. -->
    <form action="" method="post">
      <input type="text" name="username">
      <input type="password" name="pass">
      <input type="submit" value="login">
    </form>
    <a href="logout.php">Log uit</a>
  </body>
</html>