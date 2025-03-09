CREATE TABLE Lieferdatum (
 Liefernummer integer NOT NULL,
 Lieferzeitpunkt timestamp NOT NULL,
 Lieferort varchar(15)  NOT NULL,
 PRIMARY KEY(Liefernummer)
);

CREATE TABLE Lieferant (
 LieferantenID integer NOT NULL,
 Name varchar(15) NOT NULL,
 Versandfirma varchar(15)  NOT NULL,
 PRIMARY KEY(LieferantenID)
);

CREATE TABLE Bestellung (
 Bestellnummer integer NOT NULL,
 Bestelldatum date NOT NULL,
 Bestellstatus varchar(15) NOT NULL,
 PRIMARY KEY(Bestellnummer)
);

CREATE SEQUENCE seq_bestellung_bnm
START WITH 100
INCREMENT BY 1;

CREATE OR REPLACE TRIGGER tri_bestellung_bnm 
 BEFORE INSERT  ON BESTELLUNG
 FOR EACH ROW  
  BEGIN    
    SELECT seq_bestellung_bnm.nextval  INTO :new.BESTELLNUMMER   FROM dual;  
 END;
/

CREATE TABLE Liefert (
 Liefernummer integer NOT NULL,
 LieferantenID integer NOT NULL,
 Bestellnummer integer NOT NULL,
 PRIMARY KEY (Liefernummer,Bestellnummer)
);

CREATE TABLE ARTIKEL (
 ARTIKELNUMMER integer NOT NULL,
 ARTIKELPREIS integer NOT NULL,
 ARTIKELBEZEICHNUNG varchar(30) NOT NULL,
 BESTELLNUMMER integer NOT NULL,
 CONSTRAINT check_artikelpreis CHECK (ARTIKELPREIS BETWEEN 1 and 1000000), 
 PRIMARY KEY(ARTIKELNUMMER),
 FOREIGN KEY(BESTELLNUMMER) REFERENCES BESTELLUNG
 ON DELETE CASCADE
);

CREATE SEQUENCE seq_artikel_anm
START WITH 10
INCREMENT BY 1;

CREATE OR REPLACE TRIGGER tri_artikel_anm
 BEFORE INSERT  ON ARTIKEL
 FOR EACH ROW  
  BEGIN    
    SELECT seq_artikel_anm.nextval    INTO :new.ARTIKELNUMMER    FROM dual;  
 END;
/

CREATE TABLE MITARBEITER (
 MITARBEITER_ID INTEGER NOT NULL,
 VORNAME VARCHAR(15) DEFAULT 'MAX',
 NACHNAME VARCHAR(15) DEFAULT 'MUSTERMANN',
 PRIMARY KEY(MITARBEITER_ID)
);

CREATE TABLE Lagermitarbeiter (
 LagerID integer NOT NULL,
 Staplerschein number(1),
 Lagerbereich varchar(15),
 MitarbeiterID integer NOT NULL,
 PRIMARY KEY (LagerID),
 FOREIGN KEY(MitarbeiterID) REFERENCES Mitarbeiter
 );
 

CREATE TABLE Verpackt (
 Artikelnummer integer NOT NULL,
 LagerID integer NOT NULL,
 PRIMARY KEY(LagerID, Artikelnummer),
 FOREIGN KEY(Artikelnummer) REFERENCES Artikel,
 FOREIGN KEY(LagerID) REFERENCES Lagermitarbeiter
);

CREATE TABLE Büromitarbeiter (
 BüroID integer NOT NULL,
 Ausbildungsbefugnis number(1),
 Bürobereich varchar(15),
 LieferantenID integer NOT NULL,
 MitarbeiterID integer NOT NULL,
 PRIMARY KEY(BüroID),
 FOREIGN KEY(LieferantenID) REFERENCES Lieferant,
 FOREIGN KEY(MitarbeiterID) REFERENCES Mitarbeiter
);

CREATE TABLE Abteilungspass (
 AbteilungspassID integer NOT NULL,
 Geburtsdatum date,
 Anstellungsdauer integer,
 MitarbeiterID integer NOT NULL,
 PRIMARY KEY(AbteilungspassID,MitarbeiterID),
 FOREIGN KEY(MitarbeiterID) REFERENCES Mitarbeiter
);


COMMIT;

SELECT *FROM Bestellung;

SELECT *FROM Artikel;

