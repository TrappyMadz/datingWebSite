<?php
session_start();
if ( !isset($_SESSION['username'])  ) {
    header("Location: connexion.php");
    exit();
}

// Récupération du statut :
include 'bdd.php';
$username = $_SESSION['username'];
$sql = "SELECT statut FROM utilisateurs WHERE pseudo = '$username'";
$resultat = $conn->query($sql);
$row = $resultat->fetch_assoc();
$statut = $row['statut'];
// Vérification si admin :
if ( !($statut == 'admin') ) {
    header("Location: accueil.php");
    exit();
}
if (isset($_GET["idSupr"]) ) {
    $idSupr = $_GET['idSupr'];
}

// Création de la connexion
$conn = new mysqli("localhost", "Madz", "Nathan-412", "bdd");

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$sql = "DELETE FROM signalement WHERE id = '$idSupr'";

if ($conn->query($sql) === TRUE) {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Pistons & Passions</title>
	<!-- Pour l'icone de l'onglet : -->
	<link rel="shortcut icon" href="img/logo.png" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/styleAdmin.css" />
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
    <!-- Pour avoir des icons (la loupe) : -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
    <?php
        include 'header.php';
    ?>
    
    <p id="validationMsg">Le signalement à été fermé avec succés<p>
    <button onclick="history.go(-1);">Retour</button>
</body>
</html>
<?php
        } else {
            echo "Erreur lors de la suppression du signalement : " . $conn->error;
        }       

        // Fermeture de la connexion
        $conn->close();
?>