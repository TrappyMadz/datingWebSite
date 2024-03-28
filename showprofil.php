<?php
session_start();
include 'nonAccessiblePhpPages/bdd.php';
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
}
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pistons & Passions</title>
	<!-- Pour l'icone de l'onglet : -->
	<link rel="shortcut icon" href="img/logo.png" />
	<link rel="stylesheet" type="text/css" href="css/stylePro.css" />
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
</head>

<body>
    <?php
        // Menu :
        include 'nonAccessiblePhpPages/header.php';
    ?>

    <div class="Page_Principale">

        <?php
            echo '<img src="'.$url.'" width="200em">';
            echo '<p>'.$name.' '.$surname.'</p>';
            echo '<p>'.$city.'</p>';
        ?>
        <br><br><br>


       
    </div>
</body>
</html>