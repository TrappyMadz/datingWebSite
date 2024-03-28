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
    
    <script>
        function dispUser() {
            document.getElementById("userList").style.display = "flex";
        }

        function stopUser() {
            document.getElementById("userList").style.display = "none";
        }
    </script>

    <?php
        // Menu :
        include 'header.php';
    ?>

    <div class="Page_Principale">
        <h1> Bienvenue sur la page d'administration : </h1>

        <div id="container">
            <h3>Gestion : </h3>
            <div id="optionList">
                <button><img src="img/utilisateur.png" alt="Utilisateur" onclick="dispUser();"></button>
                <button><img src="img/bell.png" alt="Signalements"</button>
            </div>
        </div>


        <div id="userList">
            <?php
            // Menu :
            include 'header.php';
            ?>

            <h2> Tous les utilisateurs : </h2><br>
            <?php    

                $sql = "SELECT count(*) as nbrtot FROM utilisateurs";
                $result = $conn->query($sql);         
                $row = $result->fetch_assoc();
                $nbrtot = $row['nbrtot'];

                for ($i= $nbrtot  -1; $i >= 0 ; $i--) { 
                    $sql = "SELECT pseudo FROM utilisateurs LIMIT $i , 1";
                    $resultat = $conn->query($sql);
                    $row = $resultat->fetch_assoc();
                    $pseudo = $row['pseudo'];
                    echo '<a class="liste" href="showprofil.php?pseudo='.$pseudo.'">'.$pseudo.'</a>';
                    
               }
            ?> 
            <br>

            <button onclick="stopUser();">Retour</button>
        </div>
    </div>



</body>
</html>
