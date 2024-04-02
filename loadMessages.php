<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: connexion.php");
        exit();
    }
    
    // Inclure le fichier de connexion à la base de données
    include 'bdd.php';

    // Rerécupère le pseudo du destinataire depuis l'URL
    if (isset($_GET['pseudo'])) {
        $pseudo_recipient = $_GET['pseudo'];
    
        // Utiliser des requêtes préparées pour éviter les injections SQL
        $stmt = $conn->prepare('SELECT * FROM messages WHERE (pseudo_sender = ? AND pseudo_recipient = ?) OR (pseudo_sender = ? AND pseudo_recipient = ?)');
        $stmt->bind_param("ssss", $_SESSION['username'], $pseudo_recipient, $pseudo_recipient, $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Affiche les messages :
        while ($message = $result->fetch_assoc()) {
            if ($message['pseudo_recipient'] == $_SESSION['username']) {
                // Messages du destinataire :
                ?>

    <div class="destMSG">
        <?php
        echo "<p class='mess_recipient'>" . $message['content'] . "</p>";
        echo "<a href='signaler.php?aSigna=".$message['id']."' class='optionMessUser'><img class='reportImg' src='img/Report.png'></a>
                            </div>";
    ?>
</div>

                <?php
            } else {
                // Messages de l'expéditeur :
                echo "<p class='mess_sender'>" . $message['content'] . "</p>";
            }
        }
    } else {
        echo "ERREUR : Problème de chargement de message . . .";
    }
?>
