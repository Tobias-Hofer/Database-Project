<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();


$artikelpreis = '';
if(isset($_POST['artikelpreis'])){
    $artikelpreis = $_POST['artikelpreis'];
}

$artikelbezeichnung = '';
if(isset($_POST['artikelbezeichnung'])){
    $artikelbezeichnung = $_POST['artikelbezeichnung'];
}

$bestellnummer = '';
if(isset($_POST['bestellnummer'])){
    $bestellnummer = $_POST['bestellnummer'];
}

// Insert method
$success = $database->insertIntoArtikel($artikelpreis, $artikelbezeichnung, $bestellnummer);

// Check result
if ($success){
    echo "Bestellung '{$artikelbezeichnung} {$artikelpreis} {$bestellnummer}' Erfolgreich hinzugefügt!'";
}
else{
    echo "Die Bestellung kann nicht hinzugefügt werden! '{$artikelbezeichnung} {$artikelpreis} {$bestellnummer}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>