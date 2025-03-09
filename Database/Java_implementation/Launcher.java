import java.sql.*;
import java.text.SimpleDateFormat;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.List;

public class Launcher {

	private static final String DB_CONNECTION_URL = "jdbc:oracle:thin:@oracle19.cs.univie.ac.at:1521:orclcdb";
	private static final String USER = "a12036902";
	private static final String PASS = "dbs23";

	private static final String csvPath = "./src/resources/Data.csv";

	private static Statement stmt;
	private static Connection con;

	public static void main(String[] args) throws SQLException {

		try {

			con = DriverManager.getConnection(DB_CONNECTION_URL, USER, PASS);
			stmt = con.createStatement();

			readData();

			con.close();

		} catch (Exception e) {
			e.printStackTrace();
		}

	}

	private static void readData() throws Exception {

		BufferedReader br = new BufferedReader(new FileReader(csvPath));
		String line;

		while ((line = br.readLine()) != null) {
			String[] data = line.split(",");

			String articleQuery = "INSERT INTO ARTIKEL (ARTIKELPREIS,ARTIKELBEZEICHNUNG,BESTELLNUMMER) VALUES (?,?,?)";
			String orderQuery = "INSERT INTO BESTELLUNG (BESTELLDATUM,BESTELLSTATUS) VALUES (?,?)";

			PreparedStatement orderStatement = con.prepareStatement(orderQuery, new String[] { "Bestellnummer" });
			orderStatement.setString(1, data[1]);
			orderStatement.setString(2, data[2]);
			orderStatement.executeUpdate();

			ResultSet generatedOrderkeys = orderStatement.getGeneratedKeys();
			while (generatedOrderkeys.next()) {
				PreparedStatement articleStatement = con.prepareStatement(articleQuery);
				articleStatement.setFloat(1, Float.parseFloat(data[4]));
				articleStatement.setString(2, data[5]);
				articleStatement.setInt(3, generatedOrderkeys.getInt(1));
				articleStatement.executeUpdate();
			}

		}

		br.close();

	}

}
