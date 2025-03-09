<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();


$bestelldatum = '';
if(isset($_POST['bestelldatum'])){
    $bestelldatum = date('d-m-y', strtotime($_POST['bestelldatum']));
}

$bestellstatus = '';
if(isset($_POST['bestellstatus'])){
    $bestellstatus = $_POST['bestellstatus'];
}

// Insert method
$success = $database->insertIntoBestellung($bestelldatum, $bestellstatus);

// Check result
if ($success){
    echo "Bestellung '{$bestelldatum} {$bestellstatus}' Erfolgreich hinzugefügt!'";
}
else{
    echo "Die Bestellung kann nicht hinzugefügt werden! '{$bestelldatum} {$bestellstatus}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>