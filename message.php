
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}


// Inclure le fichier de connexion à la base de données
include 'bdd.php';


$pseudo_sender = $_SESSION['username'];
// - - - - - - - - -- - -  à changer en fct de à qui on envoie - - - - - - - - - - - - - - - -
$pseudo_recipient = "b";


// Envoi d'un mess :
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST['message'];

    $sql = "INSERT INTO messages (content, pseudo_sender, pseudo_recipient) VALUES ('$content', '$pseudo_sender', '$pseudo_recipient')";

    if ($conn->query($sql) == TRUE) {
        echo "Message envoyé !";
        // to reload the page just in case :
        header("Location: message.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
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

            <br><br>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <label for="message">Message :</label><br><br>
                <textarea name="message" class="mess_zone" required></textarea>
                <br><br>                
                <input type="submit" class="bouton" value="Envoyer">
            </form>

            <br><br><br>
            <section id="chat">
                <h2> Recup et affichage des messages : </h2>
                <?php
                    
                    $dbname = new PDO('mysql:host=localhost;dbname=bdd;charset=utf8;', 'Madz', 'Nathan-412');
                    $recupMessage = $dbname->prepare('SELECT * FROM messages WHERE pseudo_sender = ? AND pseudo_recipient = ? 
                                                        OR pseudo_sender = ? AND pseudo_recipient = ?');              
                    $recupMessage->execute(array($_SESSION['username'], $pseudo_recipient, $pseudo_recipient, $_SESSION['username']));
                    while($message = $recupMessage->fetch()){
                        if($message['pseudo_recipient']==$_SESSION['username']){
                            // messages from the recipient :
                            ?><p class='mess_recipient'>
                                <?php echo $message['content'];?>
                            </p><?php
                        }else{
                            // messages from the sender :
                            ?><p class='mess_sender'>
                                <?php echo $message['content'];?>
                            </p><?php
                        }
                        
                    }
                ?>
            </section>

        </div>




    </div>
</body>
</html>
