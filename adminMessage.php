<?php
session_start();
if (!isset($_SESSION['username'])) {
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

// Inclure le fichier de connexion à la base de données
include 'bdd.php';

$pseudo_sender = $_GET['pseudo1'];
$pseudo_recipient = '';

//Récupère à qui on envoit le message :
if (isset($_GET['pseudo2'])) {
    $pseudo_recipient = $_GET['pseudo2'];
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
    <!-- Pour import la biblio jquery (pour l'instantanéité) : -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    
    <?php
        // Menu :
        include 'header.php';
    ?>

    <div class="Page_Principale">

        <?php 
            echo "<h1>Messagerie entre $pseudo_sender et $pseudo_recipient : </h1>";
        
        ?>

        <div class="menuBlock" id="mess">

            <h2> Recup et affichage des messages : </h2>
            <section id="chat">
                <?php
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
                    


            <!-- Instantanéité : -->
            <script>
                /* reload toutes les 1s la section id="chat" */
                setInterval(function() {
                    /* garde l'info du $pseudo_recipient dans le loadMessages.php */
                    $('#chat').load('adminLoadMessages.php?pseudo=<?php echo urlencode($pseudo_recipient); ?>&pseudo2=<?php echo urlencode($pseudo_sender); ?>');
                }, 1000);

            </script>




        </div>
    </div>
</body>
</html>
