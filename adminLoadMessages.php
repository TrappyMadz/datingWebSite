<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: connexion.php");
        exit();
    }
    
    // Inclure le fichier de connexion à la base de données
    include 'bdd.php';

    // Rerécupère le pseudo du destinataire depuis l'URL
    if (isset($_GET['pseudo']) && isset($_GET['pseudo2'])) {
        $pseudo_recipient = $_GET['pseudo'];
        $pseudo_sender = $_GET['pseudo2'];
    
        // Utiliser des requêtes préparées pour éviter les injections SQL
        $stmt = $conn->prepare('SELECT * FROM messages WHERE (pseudo_sender = ? AND pseudo_recipient = ?) OR (pseudo_sender = ? AND pseudo_recipient = ?)');
        $stmt->bind_param("ssss", $pseudo_sender, $pseudo_recipient, $pseudo_recipient, $pseudo_sender);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Affiche les messages :
        while ($message = $result->fetch_assoc()) {
            if ($message['pseudo_recipient'] == $pseudo_sender) {
                // Messages du destinataire :
                echo "<p class='mess_recipient'>" . $message['content'] . "</p>";
            } else {
                // Messages de l'expéditeur :
                echo "<p class='mess_sender'>" . $message['content'] . "</p>";
            }
        }
    } else {
        echo "ERREUR : Problème de chargement de message . . .";
    }
?>