<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: accueil.php");
    exit();
}


$dbname = new PDO('mysql:host=localhost;dbname=bdd;charset=utf8;', 'Voidhi', 'TooVoonua4nu');

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

    <div class="Page_Principale">

        <h1> Page admin : </h1>

        <p> Tous les utilisateurs : </p>
        <?php               
            $recupUser = $dbname->query('SELECT * FROM utilisateurs');
            while($user = $recupUser->fetch()){
                echo $user['nom_utilisateur'];
                ?> <br> <?php
            }
        ?>
    </div>



</body>
</html>