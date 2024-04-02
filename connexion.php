<?php
include 'nonAccessiblePhpPages/bdd.php';
session_start();
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
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT mot_de_passe FROM utilisateurs WHERE pseudo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['mot_de_passe'];
        if (password_verify($password, $hashed_password)) {
            echo "Connexion réussie !";
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: accueil.php");
            exit();
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

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
