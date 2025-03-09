<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include DatabaseHelper.php file
require_once('DatabaseHelper.php');

// Instantiate DatabaseHelper class
$database = new DatabaseHelper();


$bestellnummer = '';
if (isset($_GET['bestellnummer'])) {
    $bestellnummer = $_GET['bestellnummer'];
}

$bestelldatum = '';
if (isset($_GET['bestelldatum'])) {
    $bestelldatum = $_GET['bestelldatum'];
}

$bestellstatus = '';
if (isset($_GET['bestellstatus'])) {
    $bestellstatus = $_GET['bestellstatus'];
}

$artikelnummer = '';
if (isset($_GET['artikelnummer'])) {
    $artikelnummer = $_GET['artikelnummer'];
}

$artikelpreis = '';
if (isset($_GET['artikelpreis'])) {
    $artikelpreis = $_GET['artikelpreis'];
}

$artikelbezeichnung = '';
if (isset($_GET['artikelbezeichnung'])) {
    $artikelbezeichnung = $_GET['artikelbezeichnung'];
}


//Fetch data from database
$bestellung_array = $database->selectFromBestellungWhere($bestellnummer, $bestelldatum, $bestellstatus);

$artikel_array = $database->selectFromArtikelWhere($artikelnummer,$artikelpreis,$artikelbezeichnung,$bestellnummer);

?>


<html>
<head>
    <title>Meine Datenbank Website!</title>
</head>

<body>
<br>
<h1>My PHP Project</h1>

<!-- Add Bestellung -->
<h2>Bestellung hinzufügen: </h2>
<form method="post" action="addBestellung.php">

    <!-- Bestelldatum textbox -->
    <div>
        <label for="new_bestelldatum">Bestelldatum:</label>
        <input id="new_bestelldatum" name="bestelldatum" type="date" maxlength="8">
    </div>
    <br>

    <!-- Bestellstatus textbox -->
    <div>
        <label for="new_bestellung">Bestellstatus:</label>
        <input id="new_bestellung" name="bestellstatus" type="text" maxlength="15">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Bestellung hinzufügen
        </button>
    </div>
</form>
<br>
<hr>

<!-- Bestellung löschen -->
<h2>Bestellung Löschen: </h2>
<form method="post" action="delBestellung.php">
  
    <!-- Bestellnummer textbox -->
    <div>
        <label for="del_bestellung">Bestellnummer:</label>
        <input id="del_bestellung" name="id" type="number" min="0">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Bestellung Löschen
        </button>
    </div>
</form>
<br>
<hr>

<!-- Search form -->
<h2>Bestellung Suchen:</h2>
<form method="get">

    <!-- Bestellnummer textbox:-->
    <div>
        <label for="bestellnummer">Bestellnummer:</label>
        <input id="bestellnummer" name="bestellnummer" type="number" value='<?php echo $bestellnummer; ?>' min="0">
    </div>
    <br>

    <!-- Bestelldatum textbox:-->
    <div>
        <label for="bestelldatum">Bestelldatum:</label>
        <input id="bestelldatum" name="bestelldatum" type="date" value='<?php echo $bestelldatum; ?>'
               maxlength="20">
    </div>
    <br>

    <!-- Bestellstatus textbox:-->
    <div>
        <label for="bestellstatus">Bestellstatus:</label>
        <input id="bestellstatus" name="bestellstatus" type="text"
               value='<?php echo $bestellstatus; ?>' maxlength="15">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Suche
        </button>
    </div>
</form>
<br>
<hr>

<!-- Suche result -->
<h2>Bestellung Suche Ergebnisse:</h2>
<table>
    <tr>
        <th>Bestellnummer</th>
        <th>Bestelldatum</th>
        <th>Bestellstatus</th>
    </tr>
    <?php foreach ($bestellung_array as $bestellung) : ?>
        <tr>
            <td><?php echo $bestellung['BESTELLNUMMER']; ?>  </td>
            <td><?php echo $bestellung['BESTELLDATUM']; ?>  </td>
            <td><?php echo $bestellung['BESTELLSTATUS']; ?>  </td>
        </tr>
    <?php endforeach; ?>
</table>


<br>

<!-- Add Artikel-->
<h2>Artikel hinzufügen: </h2>
<form method="post" action="addArtikel.php">
 
    <!-- Artikelpreis textbox -->
    <div>
        <label for="new_artikelpreis">Artikelpreis:</label>
        <input id="new_artikelpreis" name="artikelpreis" type="number" maxlength="15">
    </div>
    <br>

    <!-- Artikelbezeichnung textbox -->
    <div>
        <label for="new_artikelbezeichnung">Artikelbezeichnung:</label>
        <input id="new_artikelbezeichnung" name="artikelbezeichnung" type="text" maxlength="15">
    </div>
    <br>

    <!-- Bestellnummer textbox -->
    <div>
        <label for="bestellnummer">Bestellnummer:</label>
        <input id="bestellnummer" name="bestellnummer" type="number" maxlength="15">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Artikel hinzufügen
        </button>
    </div>
</form>
<br>
<hr>

<!-- Artikel löschen -->
<h2>Artikel Löschen: </h2>
<form method="post" action="delArtikel.php">
   
    <!-- Artikelnummer textbox -->
    <div>
        <label for="del_artikel">Artikelnummer:</label>
        <input id="del_artikel" name="id" type="number" min="0">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Artikel Löschen
        </button>
    </div>
</form>
<br>
<hr>

<!-- Suche form -->
<h2>Artikel Suchen:</h2>
<form method="get">
     
    <!-- Artikelnummer textbox:-->
    <div>
        <label for="artikelnummer">Artikelnummer:</label>
        <input id="artikelnummer" name="artikelnummer" type="number" value='<?php echo $artikelnummer; ?>' min="0">
    </div>
    <br>

    <!-- Artikelpreis textbox:-->
    <div>
        <label for="artikelpreis">Artikelpreis:</label>
        <input id="artikelpreis" name="artikelpreis" type="number" value='<?php echo $artikelpreis; ?>'
               maxlength="20">
    </div>
    <br>

    <!-- Artikelbezeichnung textbox:-->
    <div>
        <label for="artikelbezeichnung">Artikelbezeichnung:</label>
        <input id="artikelbezeichnung" name="artikelbezeichnung" type="text" value='<?php echo $artikelbezeichnung; ?>' maxlength="15">
    </div>
    <br>

 <!-- Bestellnummer textbox:-->
    <div>
        <label for="bestellnummer">Bestellnummer:</label>
        <input id="bestellnummer" name="bestellnummer" type="number" value='<?php echo $bestellnummer; ?>' maxlength="15">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Suche
        </button>
    </div>
</form>
<br>
<hr>

<!-- Suche result -->
<h2>Artikel Suche Ergebnisse:</h2>
<table>
    <tr>
        <th>Artikelnummer</th>
        <th>Artikelpreis</th>
        <th>Artikelbezeichnung</th>
        <th>Bestellnummer</th>
    </tr>
    <?php foreach ($artikel_array as $artikel) : ?>
        <tr>
            <td><?php echo $artikel['ARTIKELNUMMER']; ?>  </td>
            <td><?php echo $artikel['ARTIKELPREIS']; ?>  </td>
            <td><?php echo $artikel['ARTIKELBEZEICHNUNG']; ?>  </td>
            <td><?php echo $artikel['BESTELLNUMMER']; ?>  </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>