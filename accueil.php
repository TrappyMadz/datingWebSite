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
    <script>
        function chercher_user() {
            const inputValue = document.getElementById('searchInput').value;
            if (inputValue.trim() === '') {
                document.getElementById('proposition').innerHTML = '';
                return;
            }

            fetch('fetch_users.php?search=' + inputValue)
                .then(response => response.json())
                .then(users => {
                const propositionDiv = document.getElementById('proposition');
                propositionDiv.innerHTML = '';
                if (users.length > 0) {
                    users.forEach(user => {
                        const userLink = document.createElement('a');
                        userLink.textContent = user;
                        userLink.href = 'showprofil.php?pseudo=' + user;
                        userLink.classList.add('recherches');
                        propositionDiv.appendChild(userLink);
                    });
                } else {
                    propositionDiv.textContent = 'Aucun utilisateur trouvé.';
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function redirection() {
            const searchValue = document.getElementById('searchInput').value;
            const form = document.querySelector('.SearchBar');
            form.action = 'showprofil.php?pseudo=' + encodeURIComponent(searchValue);
            return true;
        }
    </script>
    
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
                <form class="SearchBar" action="showprofil.php" autocomplete="off" onsubmit="redirection()">
                    <input type="text" placeholder="Que recherchez-vous ?" name="pseudo" oninput="chercher_user()" id="searchInput">
                    <button type="submit" class="SearchIcon" >
                        <i class="fa fa-search"></i>
                    </button><br>
                </form>
                <div id="proposition"></div>
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
            echo "<br>";
            $sql = "SELECT count(*) as nbrtot FROM utilisateurs ";
            $result = $conn->query($sql);         
            $row = $result->fetch_assoc();
            echo "Nombre de profils : " . $row['nbrtot'];
            $nbrtot = $row['nbrtot'];
            ?>
            <div class="ZoneProfils">
            <?php
            if($nbrabonne<5){
                $boucle = $nbrabonne;
            }else{
                $boucle = 5;
            }

            for ($i = 0; $i < $boucle; $i++)  { 
                    echo "<div class=caseProfils>"; 
                        $sql = "SELECT lien, pseudo FROM utilisateurs WHERE statut = 'abonne' LIMIT $i, 1";
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
             ?> 
             </div>
        </div>

        <div class="menuBlock" id="LastProfils">
            <h3> Nos tout derniers membres : </h3>
            <div class="ZoneProfils">
                
                    <?php
                    if($nbrtot<5){
                        $boucle = $nbrtot;
                    }else{
                        $boucle = 5;
                    }

                    for ($i = 0; $i < $boucle; $i++)  { 
                        echo "<div class=caseProfils>"; 
                        $sql = "SELECT lien, pseudo FROM utilisateurs LIMIT $i, 1";
                        $resultat = $conn->query($sql);
                        $row = $resultat->fetch_assoc();
                        $lien = $row['lien'];
                        $pseudo = $row['pseudo'];
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
                        
                         


                    ?>
                
            </div>
        </div>

    </div>



</body>
</html>
