<!DOCTYPE html>
<html>
<head>
	<title>Pistons & Passions</title>
	<!-- Pour l'icone de l'onglet : -->
	<link rel="shortcut icon" href="img/logo.png" />
	<link rel="stylesheet" type="text/css" href="style.css" />
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
            <a href="menu.php">MENU</a>
            <a href="abonnements.php">ABONNEMENTS</a>
            <a href="profil.php">MON PROFIL</a>
        </nav>
            <a href="messagerie.php">
                <img id="logoMess" alt="Messagerie" src="img/envelope.png" width="45em">
            </a>
            <a><button class="bouton" href="déconnexion.php">DÉCONNEXION</button></a>
    </header>

    <div class="Page_Principale">

        <h1> Bienvenue sur Piston et Passions ! </h1>

        <div class="menuBlock" id="DivRecherche">
            <h3> Chercher quelqu'un : </h3>
            <div class="SearchBar">
                <form action="#">
                    <input type="text" placeholder="Que rechechez-vous ?" name="search">
                    <button type="submit" class="IconeLoupe" ></button>
                </form>
        </div>
        </div>

        <div class="menuBlock" id="Recommendations">
            <h3> Recommendations : </h3>
        </div>

        <div class="menuBlock" id="LastProfils">
            <h3> Nos tout derniers membres : </h3>
            <div class="ZoneProfils">
                <div class="caseProfils">
                    <img src="./img/sally.png" alt="Profil 1">
                    <p>Casseandre EEHEEH</p>
                    <p>localisation japon</p>                            
                </div>
                <div class="caseProfils">
                    <img src="./img/sally.png" alt="Profil 1">
                    <p>Jacob</p>
                    <p>localisation japon</p>                            
                </div>
                <div class="caseProfils">
                    <img src="./img/sally.png" alt="Profil 1">
                    <p>Trauma</p>
                    <p>localisation japon</p>                            
                </div>
                <div class="caseProfils">
                    <img src="./img/sally.png" alt="Profil 1">
                    <p>T'as de bô peneux tsais</p>
                    <p>localisation japon</p>                            
                </div>
                <div class="caseProfils">
                    <img src="./img/sally.png" alt="Profil 1">
                    <p>Casseandre EEHEEH</p>
                    <p>localisation japon</p>                            
                </div>
                <div class="caseProfils">
                    <img src="./img/sally.png" alt="Profil 1">
                    <p>Casseandre EEHEEH</p>
                    <p>localisation japon</p>                            
                </div>
                <div class="caseProfils">
                    <img src="./img/sally.png" alt="Profil 1">
                    <p>Casseandre EEHEEH</p>
                    <p>localisation japon</p>                            
                </div>
                <div class="caseProfils">
                    <img src="./img/sally.png" alt="Profil 1">
                    <p>Casseandre EEHEEH</p>
                    <p>localisation japon</p>                            
                </div>
            </div>
        </div>

    </div>



</body>
</html>