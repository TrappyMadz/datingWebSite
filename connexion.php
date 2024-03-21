<?php
include 'bdd.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM utilisateurs WHERE nom_utilisateur = '$username' AND mot_de_passe = '$password'";
    $resultat = $conn->query($sql);

    if ($resultat && $resultat->num_rows > 0) {

        echo "Connexion réussie !";
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: accueil.php");
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
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
            <a href="accueil.php">MENU</a>
            <a href="abonnements.php">ABONNEMENTS</a>
            <a href="profil.php">MON PROFIL</a>
        </nav>
            <a href="messagerie.php">
                <img id="logoMess" alt="Messagerie" src="img/envelope.png" width="45em">
            </a>
            <?php
            // Démarrer la session
            session_start();

            // Vérifier si l'utilisateur est connecté
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                // Si l'utilisateur est connecté, changer le lien de connexion
                echo '<a href="deconnexion.php" class="bouton">DECONNEXION</a>';
            } else {
                // Si l'utilisateur n'est pas connecté, afficher le lien de connexion
                echo '<a href="connexion.php" class="bouton">CONNEXION</a>';
            }
            ?>
    </header>
    <div id="Connexion">
        <h2>Connexion</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="username">Nom d'utilisateur:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" class="bouton" value="Se connecter">
        </form>
        <br>
        <a href="inscription.php">Inscription</a>
    </div>
</body>
</html>
