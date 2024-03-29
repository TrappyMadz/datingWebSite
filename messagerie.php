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
        <h2> (Là ya tous les utilisateirs de la bdd ; labda, abonnés et admin) </h2>

        <?php

            $dbname = new PDO('mysql:host=localhost;dbname=bdd;charset=utf8;', 'test', 'Motdepassechiant0*');           
            $recupUser = $dbname->query('SELECT * FROM utilisateurs');
            while($user = $recupUser->fetch()){
                $pseudo = $user['pseudo'];
                echo '<a href="message.php?pseudo='.$pseudo.'"> Messagerie avec '.$pseudo.' </a><br>';
             
            }
        ?>

    </div>



</body>
</html>