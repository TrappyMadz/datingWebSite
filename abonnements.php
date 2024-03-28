<?php
session_start();
include 'bdd.php';
if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $sql = "UPDATE utilisateurs SET statut = 'abonne' WHERE pseudo = '$username'";
    
    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        echo "Abonnement réussi !";
    } else {
        echo "Erreur lors de la mise à jour du statut : " . $conn->$error;
    }
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Pistons & Passions</title>
	<!-- Pour l'icone de l'onglet : -->
	<link rel="shortcut icon" href="img/logo.png" />
	<link rel="stylesheet" type="text/css" href="css/styleAbo.css" />
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
</head>

<body>
    
    <?php
        // Menu :
        include 'header.php';
    ?>
    

    <h1> Abonnez-vous et gagnez de nombreux avantages ! </h1>
    <p> Envoyez des messages à vos coup de moteur</p>
    <p> Soyez au courant des voitures qui sont passées sur votre profil</p>
    <div class="Page_Principale">
        <br>
        <div id="cote">
            <div class="container">
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="radio-toolbar">
                        <input type="radio" id="radioTarif1" name="tarif" value="Tarif1" checked>
                        <label for="radioTarif1">1 mois<br>5€</label>

                        <input type="radio" id="radioTarif2" name="tarif" value="Tarif2">
                        <label for="radioTarif2">3 mois<br>13€</label>

                        <input type="radio" id="radioTarif3" name="tarif" value="Tarif3">
                        <label for="radioTarif3">1 an<br>50€</label>
                    </div>
                    <h3>Paiement</h3>
                    <label for="fname">Cartes acceptées</label>
                    <div class="icon-container">
                        <img class="card" src="./img/mastercard.png" alt="Master">
                        <img class="card" src="./img/bluecard.png" alt="Blue">
                        <img class="card" src="./img/redcard.png" alt="Red">
                        <img class="card" src="./img/visa.png" alt="Visa">
                    </div>
                    <label for="cname">Nom sur la carte</label>
                    <input type="text" id="cname" name="cardname" required>
                    <label for="ccnum">Numéro de carte</label>
                    <input type="number" id="ccnum" name="cardnumber" required>
                    <label for="exp">Date expiration</label>
                    <input type="month" id="exp" name="exp" required>
                    <label for="cvv">CVV</label>
                    <input type="number" id="cvv" name="cvv" required>
                    <input type="submit" value="Payer" class="btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
