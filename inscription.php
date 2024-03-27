<?php
include 'bdd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = addslashes($_POST['name']);
    $surname = addslashes($_POST['surname']);
    $username = addslashes($_POST['username']);
    $email = $_POST['email'];
    $password = addslashes($_POST['password']);
    $address = addslashes($_POST['address']);
    $city = $_POST['city'];
    $sexe = $_POST['sexe'];
    
    $sql = "SELECT * FROM utilisateurs WHERE pseudo = '$username'";
    $resultat = $conn->query($sql);
    if ($resultat && $resultat->num_rows == 0) {
        $sql = "INSERT INTO utilisateurs (nom, prenom, pseudo, email, mot_de_passe, adresse, ville, statut, lien, sexe) VALUES ('$name', '$surname','$username', '$email', '$password', '$address', '$city', 'utilisateur', 'https://cdn-icons-png.flaticon.com/512/20/20079.png', '$sexe')";
        if ($conn->query($sql) === TRUE) {
            echo "Inscription réussie !";
            header("Location: connexion.php");
            exit();
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Pseudo déjà pris !";
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
    <div id="inscription">
        <h2>Inscription</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Nom:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="surname">Prénom:</label><br>
            <input type="text" id="surname" name="surname" required><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="username">Pseudo:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="genreF">Genre : </label>
            <br />
            <div id="sexChange">
              <input type="radio" id="genreF" name="sexe" value="1" required />
              <label for="genreF" class="labelGenre" id="labelF">Femme</label>
              <input type="radio" id="genreM" name="sexe" value="2" required />
              <label for="genreM" class="labelGenre" id="labelH">Homme</label>
            </div>
            <label for="password">Mot de passe:</label><br>
            <input type="password" id="password" name="password" required><br>
            <label for="address">Adresse:</label><br>
            <input type="text" id="address" name="address" required><br>
            <label for="city">Ville:</label><br>
            <input type="text" id="city" name="city" required><br><br>
            <input type="submit" class="bouton" value="S'inscrire">
        </form>
        <br>
        <a href="connexion.php">Connexion</a>
    </div>
</body>
</html>
