<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}

// Inclure le fichier de connexion à la base de données
include 'bdd.php';

$pseudo_sender = $_SESSION['username'];
$pseudo_recipient = '';

//Récupère à qui on envoit le message :
if (isset($_GET['pseudo'])) {
    $pseudo_recipient = $_GET['pseudo'];
}


// Envoi d'un mess :
if ( ($_SERVER["REQUEST_METHOD"] == "POST") && !(empty($_POST['message']))) {

    // htmlspecialchars() -> empèche que la personne envoit du code
    // nl2br() -> permet que le message contienne des sauts de lignes
    $content = nl2br( htmlspecialchars($_POST['message']) );

    if ($_POST['pseudo_recipient'] !== $pseudo_sender) {
        $pseudo_recipient = $_POST['pseudo_recipient'];
    }

    // Utiliser des requêtes préparées pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO messages (content, pseudo_sender, pseudo_recipient) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $content, $pseudo_sender, $pseudo_recipient);

    if ($stmt->execute()) {
        echo "Message envoyé !";
        // Recharger la page avec le pseudo du destinataire dans l'URL
        header("Location: message.php?pseudo=$pseudo_recipient");
        exit();
    } else {
        echo "Erreur: " . $stmt->error;
    }
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

    <div class="Page_Principale">

        <div id='titreMess'>
            <?php 
            include 'header.php';
                echo "<h1>Messagerie entre $pseudo_sender et $pseudo_recipient : </h1>";
        
            ?>
        </div>

        <div class="menuBlock" id="mess">

            <br><br>

            <h2> Recup et affichage des messages : </h2>
            <section id="chat">
                <?php
                    // Utiliser des requêtes préparées pour éviter les injections SQL
                    $stmt = $conn->prepare('SELECT * FROM messages WHERE (pseudo_sender = ? AND pseudo_recipient = ?) OR (pseudo_sender = ? AND pseudo_recipient = ?)');
                    $stmt->bind_param("ssss", $_SESSION['username'], $pseudo_recipient, $pseudo_recipient, $_SESSION['username']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $messageNb = 0;
                    while ($message = $result->fetch_assoc()) {
                        if ($message['pseudo_recipient'] == $_SESSION['username']) {
                            ?>
                            <div class="destMSG">

                            <?php
                            echo "<p class='mess_recipient'>" . $message['content'] . "</p>";
                            echo "<a href='signaler.php?aSigna=".$message['id']."' class='optionMessUser'><img class='reportImg' src='img/Report.png'></a>
                            </div>";
                        } else {
                            // Messages de l'expéditeur :
                            echo "<p class='mess_sender'>" . $message['content'] . "</p>";
                            ?>
                            <?php
                        }
                    }

                    
                ?>
            </section>
            <br><br><br>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <label for="message">Message :</label><br><br>
                <textarea name="message" class="mess_zone" required></textarea>
                <br><br>                
                <!-- Ajout d'un champ caché pour le pseudo du destinataire -->
                <input type="hidden" name="pseudo_recipient" value="<?php echo htmlspecialchars($pseudo_recipient); ?>">
                <input type="submit" class="bouton" value="Envoyer">
            </form>
                    


            <!-- Instantanéité : -->
            <script>
                /* reload toutes les 1s la section id="chat" */
                setInterval(timer,1000);
                function timer(){
                    /* garde l'info du $pseudo_recipient dans le loadMessages.php */
                    $('#chat').load('loadMessages.php?pseudo=<?php echo urlencode($pseudo_recipient); ?>');
                }

                /* chargement de la page en bas (derniers messages) */
                window.scroll(0, document.documentElement.scrollHeight);

            
            </script>




        </div>
    </div>
</body>
</html>
