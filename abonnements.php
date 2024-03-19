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
            <a><button class="bouton" href="déconnexion.php">DÉCONNEXION</button></a>
    </header>

    <div class="Page_Principale">

        <h1> Abonnez-vous et gagnez de nombreux avantages ! </h1>
        <br>
        <div id="coteD">
        <div class="row">
            <div class="col-75">
                <div class="container">
                    <form action="/action_page.php">
                        <div class="row">
                            <div class="col-50">
                                <h3>Adresse de paiement</h3>
                                <label for="Fname">Nom complet</label>
                                <input type="text" id="fname" name="firstname">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email">
                                <label for="adr">Addresse</label>
                                <input type="text" id="adr" name="address">
                                <label for="city">Ville</label>
                                <input type="text" id="city" name="city">
                                <div class="row">
                                    <div class="col-50">
                                        <label for="departement">Département</label>
                                        <input type="text" id="departement" name="departement">
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
                                <input type="text" id="cname" name="cardname">
                                <label for="ccnum">Numéro de carte</label>
                                <input type="text" id="ccnum" name="cardnumber">
                                <label for="expmonth">Mois d'expiration</label>
                                <input type="text" id="expmonth" name="expmonth">
                                <div class="row">
                                    <div class="col-50">
                                        <label for="expyear">Année d'expiration</label>
                                        <input type="text" id="expyear" name="expyear">
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" name="cvv">
                                     </div>
                                </div>
                            </div>

                        </div>
                        <p>Total : 5€/mois</p>
                        <input type="submit" value="Continuer à payer" class="btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>