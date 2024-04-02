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
	<link rel="stylesheet" type="text/css" href="css/styleMess.css" />
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

        <?php
            $query = "SELECT * FROM utilisateurs";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $pseudo = $row['pseudo'];
                    echo '<a href="message.php?pseudo='.$pseudo.'"><button> Messagerie avec '.$pseudo.' </button></a><br>';
                }
            } else {
                echo "Il n'y a aucun utilisateur disponible pour la messagerie.";
            }

            $conn->close();
        ?>

    </div>



</body>
</html>