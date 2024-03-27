<?php
$servername = "localhost";
$username = "Madz";
$password = "Nathan-412";
$dbname = "bdd";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}
?>
