<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();


$bestellnummer = '';
if(isset($_POST['id'])){
    $bestellnummer = $_POST['id'];
}

// Delete method
$error_code = $database->deleteBestellung($bestellnummer);

// Check result
if ($error_code == 1){
    echo "Bestellung mit folgender Bestellnummer: '{$bestellnummer}' Erfolgreich gelöscht!'";
}
else{
    echo "Bestellung mit folgender Bestellnummer kann nicht gelöscht werden: '{$bestellnummer}'. Error: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>