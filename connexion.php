<?php

session_start();

include 'bdd.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM utilisateurs WHERE pseudo = '$username' AND mot_de_passe = '$password'";
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
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
</head>
<body>
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
