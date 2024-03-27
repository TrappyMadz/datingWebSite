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
    <script src="js/script.js"></script>
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

    <h1>Bienvenue sur la page d'administration : </h1>
    <br><br>
    <div id="adminDashboard">
        <div id="adminItemList">
            
            <button class="butAdmin" onclick="dispUser();"><img src="img/user.png" alt="user"><br>Utilisateurs</button>
            <button class="butAdmin"><img src="img/bell.png" alt="reporting"><br>Signalements</button>
        </div>
    </div>
    



   <div id="userList">
        <h1> Utilisateurs : </h1><br>
        <?php    
            $dbname = new PDO('mysql:host=localhost;dbname=bdd;charset=utf8;', 'Madz', 'Nathan-412');           
            $recupUser = $dbname->query('SELECT * FROM utilisateurs');
            while($user = $recupUser->fetch()){
                echo $user['pseudo'];
                ?> <br> <?php
            }
        ?>
        <button class="butAdmin" onclick="hideUserList();">Retour</button>
    </div>



</body>
</html>