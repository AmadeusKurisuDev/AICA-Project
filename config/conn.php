<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aica";

// Connessione
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Controllo connessione
if (!$conn) {
  die("Connessione fallita: " . mysqli_connect_error());
}
//echo "Connessione avvenuta con successo!";
?>