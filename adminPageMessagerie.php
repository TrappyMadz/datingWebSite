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
    <link rel="stylesheet" type="text/css" href="css/styleAdmin.css"/>
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

        <h1> Messagerie : </h1>
        <h2>  </h2>

        <?php
            $pseudo_sender = $_GET['pseudo'];
            $dbname = new PDO('mysql:host=localhost;dbname=bdd;charset=utf8;', 'test', 'Motdepassechiant0*');           
            $recupUser = $dbname->query('SELECT * FROM utilisateurs');
            while($user = $recupUser->fetch()){
                $pseudo = $user['pseudo'];
                echo '<a class="liste" href="adminMessage.php?pseudo1='.$pseudo_sender.'&pseudo2='.$pseudo.'"> Messagerie avec '.$pseudo.' </a><br>';
             
            }
        ?>

        <a class="butLien" href="adminPage.php"><button>Retour</button></a>

    </div>



</body>
</html>