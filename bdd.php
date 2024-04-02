<?php
$servername = "localhost";
$username = "test";
$password = "Motdepassechiant0*";
$dbname = "bdd";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}
?>
