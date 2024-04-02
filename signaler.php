<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}

$messageId = $_GET['aSigna'];

// Création de la connexion
$conn = new mysqli("localhost", "test", "Motdepassechiant0*", "bdd");

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérifier si le message a déjà été signalé
$sql_check = "SELECT 1 FROM signalement WHERE messageId = '$messageId' LIMIT 1";
$result_check = $conn->query($sql_check);
if ($result_check->num_rows > 0) {
    $deja = true;
}   
else {
    // Insérer le signalement dans la base de données
    $sql_insert = "INSERT INTO signalement (messageId) VALUES ('$messageId')";

    if ($conn->query($sql_insert) === TRUE) {
        // Afficher le succès
        $succe = true;
    } else {
        // Afficher l'erreur
        $error = $conn->error;
    }
}

$conn->close();

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
        include 'nonAccessiblePhpPages/header.php';
    ?>
    
    <?php if(isset($deja) && $deja): ?>
            <p class="validationMsg">Ce message a déjà été signalé.</p>
        <?php elseif(isset($succe) && $succe): ?>
            <p class="validationMsg">Le message a été signalé avec succès.</p>
        <?php elseif(isset($error)): ?>
            <p class="validationMsg">Erreur lors du signalement : <?php echo $error; ?></p>
        <?php endif; ?>
    
    <button onclick="history.go(-1);">Retour</button>

</body>
</html>