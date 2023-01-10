<?php
require_once 'db_connectie.php';

$verbinding = maakVerbinding();
$code = $_GET['code'];

$query = 
'select titel
from Stuk
where niveaucode = :niveaucode;';

$sql = $verbinding -> prepare($query);
$sql -> execute(['niveaucode' => $code]);

foreach($sql as $row){
    echo $row['titel'] . '<br>';
}

?>
