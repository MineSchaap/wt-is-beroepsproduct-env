<?php
require_once 'db_connectie.php';

$db = maakVerbinding();

$sql = '
select componist.naam, geboortedatum, componist.schoolId, m.naam as muziekschool_naam
from componist
left join muziekschool m on m.schoolId = componist.schoolId
order by naam
';//7

$data = $db->query($sql);

$componistTable = '<h1> Componisten </h1> <table>';

foreach($data as $row){
    $componistTable .= '<tr>';
    $componistTable .= '<th>' . $row['naam'] . '</th>';
    $componistTable .= '<th>' . date_format(date_create($row['geboortedatum']),"Y/m/d") . '</th>';
    if(!is_null($row['schoolId'])) $componistTable .= '<th>' . $row['muziekschool_naam'] . '</th>';
    $componistTable .= '</tr>';
}

$componistTable .= '</table>';
?>

<!doctype html>
<html lang = "nl">
    <head>
        <meta charset="UTF-8">
    </head>

    <body>
        <main>
            <?= $componistTable ?>
        </main>
    </body>
</html>