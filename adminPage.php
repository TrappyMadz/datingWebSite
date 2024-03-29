<?php

session_start();
if ( !isset($_SESSION['username'])  ) {
    header("Location: connexion.php");
    exit();
}

// Récupération du statut :
include 'nonAccessiblePhpPages/bdd.php';
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

?>


<!DOCTYPE html>
<html>
<head>
	<title>Pistons & Passions</title>
	<!-- Pour l'icone de l'onglet : -->
	<link rel="shortcut icon" href="img/logo.png" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
    <!-- Pour avoir des icons : -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    
    <?php
        // Menu :
        include 'nonAccessiblePhpPages/header.php';
    ?>

    <div class="Page_Principale">

        <h1> Page admin : </h1>

        <h2> Tous les utilisateurs : </h2><br>
        <?php    
            $dbname = new PDO('mysql:host=localhost;dbname=bdd;charset=utf8;', 'Voidhi', 'TooVoonua4nu');           
            $recupUser = $dbname->query('SELECT * FROM utilisateurs');
            while($user = $recupUser->fetch()){
                echo $user['pseudo'];
                ?> <br> <?php
            }
        ?>
    </div>



</body>
</html>