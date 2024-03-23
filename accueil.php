<?php
session_start();
include 'bdd.php';
if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pistons & Passions</title>
	<!-- Pour l'icone de l'onglet : -->
	<link rel="shortcut icon" href="img/logo.png" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
</head>

<body>
    <header> <!-- Le menu du haut :  -->
            <!-- le logo (renvoi sur le menu en cliquant) -->
            <a href="accueil.php" title="Menu">
                <img id="logoHeader" alt="logo" src="img/logo.png" width="80em">
            </a>
            <h2> Pistons & Passions </h1>
        <nav class="NavMenu">
            <a href="accueil.php">MENU</a>
            <a href="abonnements.php">ABONNEMENTS</a>
            <a href="profil.php">MON PROFIL</a>
        </nav>
        <?php
        $username = $_SESSION['username'];
        $sql = "SELECT statut FROM utilisateurs WHERE pseudo = '$username'";
        $resultat = $conn->query($sql);
        $row = $resultat->fetch_assoc();
        $statut = $row['statut'];
        if ($statut == 'abonne') {
            echo '<a href="messagerie.php">
                    <img id="logoMess" alt="Messagerie" src="img/envelope.png" width="45em">
                </a>';
        }
        ?>
            <a href="deconnexion.php" class="bouton">DECONNEXION</a>
    </header>

    <div class="Page_Principale">

        <h1> Bienvenue sur Piston et Passions ! </h1>

        <div class="menuBlock" id="DivRecherche">
            <h3> Chercher quelqu'un : </h3>
            
            <div class="ZoneSearchBar">
                <form class="SearchBar" action="#">
                    <input type="text" placeholder="Que recherchez-vous ?" name="search">
                    <button type="submit" class="SearchIcon" >
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="menuBlock" id="Recommendations">
            <h3> Recommendations : </h3>
             <?php
            $sql = "SELECT count(*) as nbr FROM utilisateurs WHERE statut = 'abonne'";
            $result = $conn->query($sql);         
            $row = $result->fetch_assoc();
            echo "Nombre d'abonnés : " . $row['nbr'];
            $nbrabonne = $row['nbr'];
            echo "<div class=ZoneProfils>";
                for ($i= $nbrabonne -1; $i >= 0 ; $i--) { 
                    echo "<div class=caseProfils>"; 
                        $sql = "SELECT lien FROM utilisateurs WHERE statut = 'abonne' LIMIT $i, 1 ";
                        $resultat = $conn->query($sql);
                        $row = $resultat->fetch_assoc();
                        $lien = $row['lien'];
                        echo '<img src="'.$lien.'" width="80em">';
                        echo '<p>';
                        $sql = "SELECT * FROM utilisateurs where statut = 'abonne' LIMIT $i, 1";
                        $res = $conn->query($sql);
                        $row = $res->fetch_assoc();
                        echo $row['prenom'];
                        echo " ";
                        echo $row['nom'];
                        echo "<br>";
                        echo $row['ville'];
                        echo '</p>';
                    echo "</div>" ;
                }
            
                if ($nbrabonne < 5) {
                    for ($i= $nbrabonne ; $i >= 0 ; $i--) { 
                        echo "<div class=caseProfils>"; 
                            $sql = "SELECT lien FROM utilisateurs WHERE statut not like 'abonne' LIMIT $i , 1";
                            $resultat = $conn->query($sql);
                            $row = $resultat->fetch_assoc();
                            $lien = $row['lien'];
                            echo '<img src="'.$lien.'" width="80em">';
                            echo '<p>';
                            $sql = "SELECT * FROM utilisateurs where statut not like 'abonne' LIMIT $i, 1";
                            $res = $conn->query($sql);
                            $row = $res->fetch_assoc();
                            echo $row['prenom'];
                            echo " ";
                            echo $row['nom'];
                            echo "<br>";
                            echo $row['ville'];
                            echo '</p>';
                        echo "</div>" ;
                    }
                }
            echo "</div>";
             ?> 
        </div>

        <div class="menuBlock" id="LastProfils">
            <h3> Nos tout derniers membres : </h3>
            <div class="ZoneProfils">
                
                    <?php
                        for ($i=4; $i >= 0; $i--) { 
                             echo "<div class=caseProfils>";

                                $username = $_SESSION['username'];
                                $sql = "SELECT lien FROM utilisateurs LIMIT $i, 1 ";
                                $resultat = $conn->query($sql);
                                $row = $resultat->fetch_assoc();
                                $lien = $row['lien'];
                                echo '<img src="'.$lien.'" width="80em">';
                                echo '<p>';
                                $sql = "SELECT * FROM utilisateurs LIMIT $i, 1";
                                $res = $conn->query($sql);
                                $row = $res->fetch_assoc();
                                echo $row['prenom'];
                                echo " ";
                                echo $row['nom'];
                                echo "<br>";
                                echo $row['ville'];
                                echo '</p>';

                            echo "</div>" ;
                        }
                         


                    ?>
                    <!-- <img src="./img/sally.png" alt="Profil 1">
                    <p>Casseandre EEHEEH</p>
                    <p>localisation japon</p>                             -->
                
            </div>
        </div>

    </div>



</body>
</html>
