<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];
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
    include 'header.php';
    ?>

    <div class="menuBlock" id="DivRecherche">
            <h3> Chercher quelqu'un : </h3>
            
            <div class="ZoneSearchBar">
                <form class = "SearchBar" action = "rechercheprofils.php" method="post">
                    <input type="text" placeholder="Que recherchez-vous ?" name="search">
                    <button type="submit" class="SearchIcon" >
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    
    <?php
    $sql = "SELECT count(*) as nbr from utilisateurs where( nom like '%$search%' OR prenom like '%$search%' OR pseudo like '%$search%')";
    $result = $conn->query($sql);         
    $row = $result->fetch_assoc();
    $nbrProfilsTrouve = $row['nbr'];


    echo "<div class=ZoneProfils>";
    for ($i=0; $i < $nbrProfilsTrouve; $i++) { 
        echo "<div class=caseProfils>"; 

        $sql = "SELECT lien, pseudo FROM utilisateurs WHERE( nom like '%$search%' OR prenom like '%$search%' OR pseudo like '%$search%') LIMIT $i, 1 ";
        $resultat = $conn->query($sql);
        $row = $resultat->fetch_assoc();
        $lien = $row['lien'];
        $pseudo = $row['pseudo'];
        echo '<a href="showprofil.php?pseudo='.$pseudo.'"><img src="'.$lien.'" width="80em"></a>';
        echo '<p>';
        $sql = "SELECT * FROM utilisateurs where ( nom like '%$search%' OR prenom like '%$search%' OR pseudo like '%$search%') LIMIT $i, 1";
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
    echo "</div>"

    ?>
</html>
