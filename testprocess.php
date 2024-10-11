<?php
// Haal de ingevoerde naam op
$naam = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';

// Verbinding maken met database test
// Databasegegevens
$servername = "localhost"; 
$username = "root"; 
$password = ""; // geen password, onveilig
$database = "test"; 

// Probeer de verbinding te maken
$conn = new mysqli($servername, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

echo "Succesvol verbonden met de database! ----";

// voeg de gegevens uit naam toe aan de tabel naam

// definieren van de SQL-query met de invoerde gegevens uit het formulier
$query = "INSERT INTO name (naam) VALUES (?)";

// Voorbereiden van de query
$stmt = $conn->prepare($query);

/*/ Controleer of het voorbereiden van de query is gelukt
if ($stmt === false) {
    die("Fout bij het voorbereiden van de query: " . $conn->error);
}
*/

// Koppel de ingevoerde parameter aan de query (bind_param)
$stmt->bind_param("s", $naam);

// Voer de query uit
if ($stmt->execute()) {
    echo "De naam is succesvol toegevoegd!";
} else {
    echo "Fout bij het toevoegen van de naam: " . $stmt->error;
}

// Sluit de statement en verbinding
$stmt->close();
$conn->close();

?>
