<?php

class DatabaseHelper
{
    // Since the connection details are constant, define them as const
    // We can refer to constants like e.g. DatabaseHelper::username
    const username = 'a12036902'; // use a + your matriculation number
    const password = 'dbs23'; // use your oracle db password
    const con_string = 'oracle19.cs.univie.ac.at:1521/orclcdb';  //on almighty "lab" is sufficient

    // Since we need only one connection object, it can be stored in a member variable.
    // $conn is set in the constructor.
    protected $conn;

    // Create connection in the constructor
    public function __construct()
    {
        try {
            // Create connection with the command oci_connect(String(username), String(password), String(connection_string))
            // The @ sign avoids the output of warnings
            // It could be helpful to use the function without the @ symbol during developing process
            $this->conn = oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );

            //check if the connection object is != null
            if (!$this->conn) {
                // die(String(message)): stop PHP script and output message:
                die("DB error: Connection can't be established!");
            }

        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    // Used to clean up
    public function __destruct()
    {
        // clean up
        oci_close($this->conn);
    }


    
    public function selectFromBestellungWhere($bestellnummer, $bestelldatum, $bestellstatus)
    {
       
        $sql = "SELECT * FROM bestellung
            WHERE bestellnummer LIKE '%{$bestellnummer}%'
              AND upper(bestelldatum) LIKE upper('%{$bestelldatum}%')
              AND upper(bestellstatus) LIKE upper('%{$bestellstatus}%')
            ORDER BY BESTELLNUMMER ASC";

       
        $statement = oci_parse($this->conn, $sql);

      
        oci_execute($statement);


        oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);

      
        oci_free_statement($statement);

        return $res;
    }
	


    public function selectFromArtikelWhere($artikelnummer, $artikelpreis, $artikelbezeichnung, $bestellnummer)
    {
        
        $sql = "SELECT * FROM artikel
            WHERE artikelnummer LIKE '%{$artikelnummer}%'
              AND (artikelpreis) LIKE ('%{$artikelpreis}%')
              AND upper(artikelbezeichnung) LIKE upper('%{$artikelbezeichnung}%')
              AND (bestellnummer) LIKE ('%{$bestellnummer}%')
            ORDER BY ARTIKELNUMMER ASC";

      
        $statement = oci_parse($this->conn, $sql);

      
        oci_execute($statement);

      
        oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);

      
        oci_free_statement($statement);

        return $res;
    }



   
    public function insertIntoBestellung($bestelldatum, $bestellstatus, $bestellnummer)
    {
        $sql = "INSERT INTO BESTELLUNG (BESTELLDATUM, BESTELLSTATUS) VALUES (TO_DATE('{$bestelldatum}', 'DD-MM-YYYY'), '{$bestellstatus}')";

        $statement = oci_parse($this->conn, $sql);
		$success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    public function deleteBestellung($bestellnummer) {

        $sql = "DELETE FROM BESTELLUNG WHERE BESTELLNUMMER = {$bestellnummer}";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    public function insertIntoArtikel($artikelpreis, $artikelbezeichnung, $bestellnummer)
    {
        $sql = "INSERT INTO ARTIKEL (ARTIKELPREIS, ARTIKELBEZEICHNUNG, BESTELLNUMMER) VALUES ('{$artikelpreis}', '{$artikelbezeichnung}', '{$bestellnummer}')";

        $statement = oci_parse($this->conn, $sql);
		$success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    public function deleteArtikel($artikelnummer) {

        $sql = "DELETE FROM ARTIKEL WHERE ARTIKELNUMMER = {$artikelnummer}";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

}