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
	<link rel="stylesheet" type="text/css" href="styleAbo.css" />
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
</head>

<body>
    <header> <!-- Le menu du haut :  -->
            <!-- le logo (renvoi sur le menu en cliquant) -->
            <a href="accueil.php" title="Menu">
                <img id="logoHeader" alt="logo" src="img/logo.png" width="80em">
            </a>
            <h2> Pistons & Passions </h1>
        <nav class="NavMenu">
            <a href="accueil.php">MENU</a>
            <a href="abonnements.php">ABONNEMENTS</a>
            <a href="profil.php">MON PROFIL</a>
        </nav>
            <a href="messagerie.php">
                <img id="logoMess" alt="Messagerie" src="img/envelope.png" width="45em">
            </a>
            <?php
            session_start();
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                echo '<a href="deconnexion.php" class="bouton">DECONNEXION</a>';
            } else {
                echo '<a href="connexion.php" class="bouton">CONNEXION</a>';
            }
            ?>
    </header>
    <h1> Abonnez-vous et gagnez de nombreux avantages ! </h1>
    <p> Envoyez des messages à vos coup de moteur</p>
    <p> Soyez au courant des voitures qui sont passées sur votre profil</p>
    <div class="Page_Principale">
        <br>
        <div id="cote">
        <div class="row">
            <div class="col-75">
                <div class="container">
                    <form action="/action_page.php">
                        <div class="row">
                            <div class="col-50">
                                <div class="radio-toolbar">
                                    <input type="radio" id="radioTarif1" name="tarif" value="Tarif1" checked>
                                    <label for="radioTarif1">1 mois<br>5€</label>

                                    <input type="radio" id="radioTarif2" name="tarif" value="Tarif2">
                                    <label for="radioTarif2">3 mois<br>13€</label>

                                    <input type="radio" id="radioTarif3" name="tarif" value="Tarif3">
                                    <label for="radioTarif3">1 an<br>50€</label>

                                </div>
                                <h3>Adresse de paiement</h3>
                                <label for="Fname">Nom complet</label>
                                <input type="text" id="fname" name="firstname" required>
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" required>
                                <label for="adr">Addresse</label>
                                <input type="text" id="adr" name="address" required>
                                <label for="city">Ville</label>
                                <input type="text" id="city" name="city" required>
                                <div class="row">
                                    <div class="col-50">
                                        <label for="departement">Département</label>
                                        <input type="text" id="departement" name="departement" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-50">
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
                                <input type="text" id="ccnum" name="cardnumber" required>
                                <label for="expmonth">Mois d'expiration</label>
                                <input type="text" id="expmonth" name="expmonth" required>
                                <div class="row">
                                    <div class="col-50">
                                        <label for="expyear">Année d'expiration</label>
                                        <input type="text" id="expyear" name="expyear" required>
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" name="cvv" required>
                                     </div>
                                </div>
                            </div>

                        </div>
                        <input type="submit" value="Payer" class="btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>