<?php
require_once 'db_connectie.php';

$db = maakVerbinding();
$id = $_GET['name'];

$sql = "select * from componist where naam = :naam";

$query = $db->prepare($sql);
$query->execute([':naam' => $id]);

foreach($query as $row){
    echo $row['naam'];
}
echo '<br><br><br><br><br><br><br><br><br><br><br><br>done';




/*
<?php
require_once 'db_connectie.php';

$db = maakVerbinding();
$id = $_GET['id'];

$sql = 'select * from componist where componistId =' . $id;

$data = $db->query($sql);

foreach($data as $row){
    echo $row['naam'];
}
echo 'done';
?>


<?php
require_once 'db_connectie.php';

$db = maakVerbinding();
$id = $_GET['id'];

$sql = "select * from componist where componistId = :id";

$query = $db->prepare($sql);
$query->execute([':id' => $id]);

foreach($query as $row){
    echo $row['naam'];
}
echo 'done';

*/
?>


