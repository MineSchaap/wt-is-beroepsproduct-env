<?php

require_once 'db_connectie.php';

// --- Functies -----------------------------
function getSelectboxschoolId($selection)
{
   $db = maakVerbinding();
   // Haal alle scholen op uit de datase en maak een selection
   $sql = 'SELECT schoolId, naam 
           FROM muziekschool
           ORDER BY naam';
   $data = $db->query($sql);

   // Maak selection box
   $selectbox = '<select name="schoolId" id="schoolId">';
   $selectbox .= "<option value=\"\">(geen)</option>";
   foreach($data as $rij) 
   {
      $schoolId = $rij['schoolId'];
      $naam = $rij['naam'];

      if($selection == $schoolId)
      {
         $selected = 'selected';
      }
      else 
      {
         $selected = '';
      }
      $selectbox .= "<option value=\"$schoolId\" $selected>$naam</option>";
   }
   $selectbox .= "</select>";

   return $selectbox;
}
// ------------------------------------------

$melding = ''; // anders een foutmelding 'Undefined variable' in de body.
$fouten = [];  // array met foutmeldingen

// Variabelen om de 'value' van de 'input' te bewaren.
$componistId    = '';
$naam           = '';
$geboortedatum  = null;
$schoolId       = null;

$db = maakVerbinding();

// Is er op 'opslaan' geklikt?
if(isset($_POST['opslaan']))
{
   // 4 kolommen, dus ook 4 variabelen
   $componistId    = htmlspecialchars(trim($_POST['componistId']));
   $naam           = htmlspecialchars(trim($_POST['naam']));
   $geboortedatum  = htmlspecialchars(trim($_POST['geboortedatum']));
   $schoolId       = htmlspecialchars(trim($_POST['schoolId']));

   // Controleer niet verplichte velden
   if(empty($geboortedatum))
   {
      $geboortedatum = null;
   }
   $schoolId = $_POST['schoolId'];
   if(empty($schoolId))
   {
      $schoolId = null;
   }

   // Controleer velden op geldigheid
   // componist id (not null, numeric)
   if(empty($componistId))
   {
      $fouten[] = 'componistId is verplicht om in te vullen.';
   }
   if(!is_numeric($componistId))
   {
      $fouten[] = 'componistId moet een numerieke waarde zijn.';
   }
   // Naam (not null, text)
   if(empty($naam))
   {
      $fouten[] = 'naam is verplicht om in te vullen.';
   }
   
   // Zijn er fouten?
   if(count($fouten) > 0)
   {
      // Fouten: maak een melding
      $melding = '<ul class="error">';
      
      foreach($fouten as $fout)
      {
         $melding .= '<li>'.$fout.'</li>';

      }
      $melding .= '</ul>';
   }
   else
   {
      // --- Database ----------- ------------------------------
      // $db = maakVerbinding();
      // Insert query (prepared statement)
      $sql = 'INSERT INTO Componist (componistId, naam, geboortedatum, schoolId) 
              values (:componistId, :naam, :geboortedatum, :schoolId);'; 
      $query = $db->prepare($sql);

      // Send data to database
      $data_array = [
         'componistId' => $componistId,
         'naam' => $naam,
         'geboortedatum' => $geboortedatum,
         'schoolId' => $schoolId
      ];
      $succes = $query->execute($data_array);

      // Check results
      if($succes)
      {
         $melding = 'Gegevens zijn opgeslagen in de database.';
         // maak de 4 variabelen weer leeg
         $componistId = '';
         $naam = '';
         $geboortedatum = '';
         $schoolId='';
      }
      else
      {
         $melding = 'Er ging iets fout bij het opslaan.';
      }
   }
}

$selectschoolId = getSelectboxschoolId($schoolId);

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componinst - nieuw</title>
    <link href="css/normalize.css" rel="stylesheet" >
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
   <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
      <label for="componistId">componistId</label>
      <input type="text" id="componistId" name="componistId" value="<?= $componistId ?>"><br>
      
      <label for="naam">naam</label>
      <input type="text" id="naam" name="naam" value="<?= $naam ?>"><br>
      
      <label for="geboortedatum">geboortedatum</label>
      <input type="date" id="geboortedatum" name="geboortedatum" value="<?= $geboortedatum ?>"><br>
      
      <label for="schoolId">schoolId</label>
      <?= $selectschoolId ?><br>
      
      <?= $melding ?><br>
      
      <input type="reset" id="reset" name="reset" value="wissen">
      <input type="submit" id="opslaan" name="opslaan" value="opslaan">
   </form>
</body>
</html>