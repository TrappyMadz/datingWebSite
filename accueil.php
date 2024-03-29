<?php
session_start();
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
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
    <!-- Pour avoir des icons (la loupe) : -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    
    <?php
        // Menu :
        include 'nonAccessiblePhpPages/header.php';
    ?>

    <div class="Page_Principale">

        <h1> Bienvenue sur Pistons et Passions ! </h1>
        <br><br>

        <?php 
            echo "<h2>Heureux de vous revoir ";
            echo $_SESSION['username'];
            echo " !</h2>";
        ?>



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
            <h3> Recommandations : </h3>
             <?php
            $sql = "SELECT count(*) as nbr FROM utilisateurs WHERE statut = 'abonne'";
            $result = $conn->query($sql);         
            $row = $result->fetch_assoc();
            echo "Nombre d'abonnés : " . $row['nbr'];
            $nbrabonne = $row['nbr'];
            echo "<br>";
            $sql = "SELECT count(*) as nbrtot FROM utilisateurs ";
            $result = $conn->query($sql);         
            $row = $result->fetch_assoc();
            echo "Nombre de profils : " . $row['nbrtot'];
            $nbrtot = $row['nbrtot'];
            
            echo "<div class=ZoneProfils>";
                for ($i= $nbrabonne -1; $i >= 0 ; $i--) { 
                    echo "<div class=caseProfils>"; 
                        $sql = "SELECT lien, pseudo FROM utilisateurs WHERE statut = 'abonne' LIMIT $i, 1 ";
                        $resultat = $conn->query($sql);
                        $row = $resultat->fetch_assoc();
                        $lien = $row['lien'];
                        $pseudo = $row['pseudo'];
                        echo '<a href="showprofil.php?pseudo='.$pseudo.'"><img src="'.$lien.'" width="80em"></a>';
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
            
                if ( ($nbrabonne < 5 ) && ( $nbrtot + $nbrabonne >= 5  ) ) {
                    for ($i= 4  - $nbrabonne; $i >= 0 ; $i--) { 
                        echo "<div class=caseProfils>"; 
                            $sql = "SELECT lien, pseudo FROM utilisateurs WHERE statut = 'utilisateur' LIMIT $i , 1";
                            $resultat = $conn->query($sql);
                            $row = $resultat->fetch_assoc();
                            $pseudo = $row['pseudo'];
                            $lien = $row['lien'];
                            echo '<a href="showprofil.php?pseudo='.$pseudo.'"><img src="'.$lien.'" width="80em"></a>';
                            echo '<p>';
                            $sql = "SELECT * FROM utilisateurs where statut = 'utilisateur' LIMIT $i, 1";
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
                if (($nbrabonne < 5 ) && ( $nbrtot + $nbrabonne < 5  )){
                    for ($i= $nbrtot  -1; $i >= $nbrabonne ; $i--) { 
                        echo "<div class=caseProfils>"; 
                            $sql = "SELECT lien, pseudo FROM utilisateurs WHERE statut = 'utilisateur' LIMIT $i , 1";
                            $resultat = $conn->query($sql);
                            $row = $resultat->fetch_assoc();
                            $pseudo = $row['pseudo'];
                            $lien = $row['lien'];
                            echo '<a href="showprofil.php?pseudo='.$pseudo.'"><img src="'.$lien.'" width="80em"></a>';
                            echo '<p>';
                            $sql = "SELECT * FROM utilisateurs where statut = 'utilisateur' LIMIT $i, 1";
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
                    if (($nbrabonne < 5 ) && ( $nbrtot + $nbrabonne < 5  )){
                        for ($i= $nbrtot -1 ; $i >= $nbrabonne ; $i--) { 
                            echo "<div class=caseProfils>"; 
                                $sql = "SELECT lien, pseudo FROM utilisateurs WHERE statut = 'utilisateur' LIMIT $i , 1";
                                $resultat = $conn->query($sql);
                                $row = $resultat->fetch_assoc();
                                $pseudo = $row['pseudo'];
                                $lien = $row['lien'];
                                echo '<a href="showprofil.php?pseudo='.$pseudo.'"><img src="'.$lien.'" width="80em"></a>';
                                echo '<p>';
                                $sql = "SELECT * FROM utilisateurs where statut = 'utilisateur' LIMIT $i, 1";
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
                    }else{
                        for ($i=4; $i >= 0; $i--) { 
                            echo "<div class=caseProfils>";

                               $username = $_SESSION['username'];
                               $sql = "SELECT lien, pseudo FROM utilisateurs LIMIT $i, 1 ";
                               $resultat = $conn->query($sql);
                               $row = $resultat->fetch_assoc();
                               $pseudo = $row['pseudo'];
                               $lien = $row['lien'];
                               echo '<a href="showprofil.php?pseudo='.$pseudo.'"><img src="'.$lien.'" width="80em"></a>';
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
                    }

                        
                         


                    ?>
                
            </div>
        </div>

    </div>



</body>
</html>
