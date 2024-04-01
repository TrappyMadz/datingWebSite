<?php
session_start();
include 'bdd.php';
if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}
if (isset($_GET['pseudo'])) {
    $username = $_GET['pseudo'];
    $sql = "SELECT * FROM utilisateurs WHERE pseudo = '$username'";
    $resultat = $conn->query($sql);
    $row = $resultat->fetch_assoc();
    $name = $row['nom'];
    $surname = $row['prenom'];
    $email = $row['email'];
    $address = $row['adresse'];
    $password2 = $row['mot_de_passe'];
    $city = $row['ville'];
    $url = $row['lien'];
    $statut = $row['statut'];

    $usernameAdmin = $_GET['pseudo'];
}


 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pistons & Passions</title>
	<!-- Pour l'icone de l'onglet : -->
	<link rel="shortcut icon" href="img/logo.png" />
	<link rel="stylesheet" type="text/css" href="css/stylePro.css" />
    <link rel="stylesheet" type="text/css" href="css/styleAdmin.css"/>
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
</head>

<body>
    <?php
        // Menu :
        include 'header.php';
    ?>

    <script>
        function dispSupr() {
            document.getElementById('suprConfirm').style.display="flex";
        }

        function stopDispSupr() {
            document.getElementById('suprConfirm').style.display="none";
        }
    </script>

    <div class="Page_Principale">

        <?php
            echo '<img src="'.$url.'" width="200em">';
            echo '<p>'.$name.' '.$surname.'</p>';
            echo '<p id="finProfile">'.$city.'</p>';

            // Admin :
            if ($statut == 'admin') {
                echo 
                '
                <div id="container">
                    <h3 id="titreGest">Gestion : </h3>
                    <div id="optionList">
                        <button><a class="butLien" href="adminPageMessagerie.php?pseudo='.$usernameAdmin.'"><img Class="boutMessAdmin" src="img/envelope.png" alt="Messages"></a></button>
                        <button><a class="butLien" href="profil.php?pseudo='.$usernameAdmin.'"><img src="img/modifProfile.png" alt="Modifier Profil"></a></button>
                        <button onclick="dispSupr();"><img src="img/supprimer.png" alt="Suppression"></button>
                    </div>
                </div>';

                ?>

                <div id="suprConfirm">
                    <?php
                        include 'header.php'
                    ?>

                    <p>
                        Voulez-vous vraiment supprimer cet utilisateur ?<br>
                        (Cette action est irréversible !)
                    </p>

                    <?php
                    echo '<button><a class="butLien" href="suprUser.php?pseudo='.$usernameAdmin.'">Oui</a></button>'
                    ?>
                    <button onclick="stopDispSupr();">Non</button>
                </div>

                <?php
            }
        ?>
        <br><br><br>


       
    </div>
</body>
</html>