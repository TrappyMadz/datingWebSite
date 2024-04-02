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
    <!-- Pour import la biblio jquery (pour l'instantanéité) : -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <?php

        include 'nonAccessiblePhpPages/bdd.php';
        $username = $_SESSION['username'];
        $sql = "SELECT statut FROM utilisateurs WHERE pseudo = '$username'";
        $resultat = $conn->query($sql);
        $row = $resultat->fetch_assoc();
        $statut = $row['statut'];

        if ( !($statut == 'admin') ) {
            header("Location: accueil.php");
            exit();
        }

        if (isset($_GET['pseudo1'])) {
            $pseudo_sender = $_GET['pseudo1'];
            $pseudo_recipient = '';
        }
    
        if (isset($_GET['pseudo2'])) {
            $pseudo_recipient = $_GET['pseudo2'];
        }


    ?>
    

    <div class="Page_Principale">

        <div id="titreMess">
        <?php 
        // Menu :
        include 'nonAccessiblePhpPages/header.php';
            echo "<h1>Messagerie entre $pseudo_sender et $pseudo_recipient : </h1>";
        
        ?>
        </div>
        <div class="menuBlock" id="mess">

            <h2> Messages : </h2>
            <section id="chat">
                <?php

                    $stmt= $conn->prepare('SELECT COUNT(*) FROM messages WHERE (pseudo_sender = ? AND pseudo_recipient = ?) OR (pseudo_sender = ? AND pseudo_recipient =?)');
                    

                    // Lier les valeurs aux paramètres
                    $stmt-> bind_param('ssss', $pseudo_sender, $pseudo_recipient, $pseudo_recipient, $pseudo_sender);

                    //execution
                    $stmt->execute();

                    // Récuperation
                    $stmt->bind_result($count);
                    $stmt->fetch();

                    // Libérer les résultats
                    $stmt->free_result();

                    // Verif
                    if ($count == 0) {
                        echo '<p>Aucun message</p>';
                    }

                    $stmt->close();

                    // Utiliser des requêtes préparées pour éviter les injections SQL
                    $stmt = $conn->prepare('SELECT * FROM messages WHERE (pseudo_sender = ? AND pseudo_recipient = ?) OR (pseudo_sender = ? AND pseudo_recipient = ?)');
                    $stmt->bind_param("ssss", $pseudo_sender, $pseudo_recipient, $pseudo_recipient, $pseudo_sender);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($message = $result->fetch_assoc()) {
                        if ($message['pseudo_recipient'] == $pseudo_sender) {
                            // Messages du destinataire :
                            echo "<p class='mess_recipient'>" . $message['content'] . "</p>";
                        } else {
                            // Messages de l'expéditeur :
                            echo "<p class='mess_sender'>" . $message['content'] . "</p>";
                        }
                    }
                ?>
            </section>

            <a class="butLien" href="adminPage.php"><button>Retour</button></a>

            <script>
                /* chargement de la page en bas (derniers messages) */
                window.scroll(0, document.documentElement.scrollHeight);
            </script>
        </div>
    </div>
</body>
</html>