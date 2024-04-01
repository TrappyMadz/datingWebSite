<?php
session_start();
include 'bdd.php';


if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}

if (isset($_GET['pseudo'])) {
    $usernameSave = $_SESSION['username'];
    $username = $_GET['pseudo'];
    
}
else {
    $username = $_SESSION['username'];
}


$sql = "SELECT * FROM utilisateurs WHERE pseudo = '$username'";
$resultat = $conn->query($sql);
$row = $resultat->fetch_assoc();
$name = $row['nom'];
$surname = $row['prenom'];
$email = $row['email'];
$address = $row['adresse'];
$password2 = $row['mot_de_passe'];
$city = $row['ville'];
$url = $row['lien'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["userValid"]) {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username2 = $_POST['username'];
    $email = $_POST['email'];
    $password2 = $_POST['password2'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $url = $_POST['url'];

    $sql_check_username = "SELECT COUNT(*) AS count FROM utilisateurs WHERE pseudo = '$username2'";
    $result_check_username = $conn->query($sql_check_username);
    $row_check_username = $result_check_username->fetch_assoc();
    $count = $row_check_username['count'];



    if ($count > 0 && $username2 !== $username) {
        echo "Le pseudo est déjà pris, veuillez en choisir un autre.";
    } else {

        $sql = "UPDATE utilisateurs SET pseudo = '$username2', nom = '$name', prenom = '$surname', email = '$email', adresse = '$address', ville = '$city', lien = '$url', mot_de_passe = '$password2' WHERE pseudo = '$username'";
        
        if ($conn->query($sql) === TRUE) {

            $_SESSION['username'] = $username2;
            
            echo "Mise à jour des informations réussie !";
        } else {
            echo "Erreur lors de la mise à jour des informations : " . $conn->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["adminChange"]) {
    $surname = $_POST['surname'];
    $username2 = $_POST['username'];
    $email = $_POST['email'];
    $password2 = $_POST['password2'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $url = $_POST['url'];

    $sql_check_username = "SELECT COUNT(*) AS count FROM utilisateurs WHERE pseudo = '$username2'";
    $result_check_username = $conn->query($sql_check_username);
    $row_check_username = $result_check_username->fetch_assoc();
    $count = $row_check_username['count'];


    if ($count > 0 && $username2 !== $username) {
        echo "Le pseudo est déjà pris, veuillez en choisir un autre. '.$username.'";
    } else {

        $sql = "UPDATE utilisateurs SET pseudo = '$username2', nom = '$name', prenom = '$surname', email = '$email', adresse = '$address', ville = '$city', lien = '$url', mot_de_passe = '$password2' WHERE pseudo = '$username'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Mise à jour des informations réussie !";
        } else {
            echo "Erreur lors de la mise à jour des informations : " . $conn->error;
        }
    }
}
?>



<script>
        function togglePassword() {
            var passwordInput = document.getElementById("password2");
            var toggleButton = document.getElementById("toggleButton");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>



<!DOCTYPE html>
<html>
<head>
	<title>Pistons & Passions</title>
	<!-- Pour l'icone de l'onglet : -->
	<link rel="shortcut icon" href="img/logo.png" />
	<link rel="stylesheet" type="text/css" href="css/stylePro.css" />
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
</head>

<body>
    <?php
        // Menu :
        include 'header.php';
        if (isset($_GET['pseudo'])) {
            $usernameSave = $_SESSION['username'];
            $username = $_GET['pseudo'];
            
        }
        else {
            $username = $_SESSION['username'];
        }
    ?>

    <div class="Page_Principale">

        <?php
       
            $sql = "SELECT lien FROM utilisateurs WHERE pseudo = '$username'";
            $resultat = $conn->query($sql);
            $row = $resultat->fetch_assoc();
            $url = $row['lien'];
            echo '<img src="'.$url.'" width="200em">';

            $sql = "SELECT * FROM utilisateurs WHERE pseudo = '$usernameSave'";
            $resultat = $conn->query($sql);
            $row = $resultat->fetch_assoc();
            $statut = $row['statut'];
        ?>
        <br><br><br>

        <form action="<?php echo htmlspecialchars($_SERVER["profil.php?pseudo='.$username.'"]); ?>" method="post" id="formprofil">
            <br><br>
            <label for="url">URL image</label>
            <input type="text" id="url" name="url" value="<?php echo $url; ?>" required>

            <label for="surname">Prénom</label>
            <input type="text" id="surname" name="surname" value="<?php echo $surname; ?>" required>

            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

            <label for="city">Ville</label>
            <input type="text" id="city" name="city" value="<?php echo $city; ?>" required>

            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>

            <label for="username">Pseudo</label>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>

            <label for="password2">Mot de passe</label>
            <input type="password" id="password2" name="password2" value="<?php echo $password2; ?>" required>
            <button type="button" id="toggleButton" onclick="togglePassword()"><img src="img/oeil.png" width=15em></button>

            <?php 
            if ($statut == 'admin') {
                echo ' <input type="submit" class="btn" value="AdminTest" name="adminChange">';
            }
            else {
                echo'<input type="submit" class="btn" value="Valider les changements" name="userValid">';
            }
            ?>

           

        </form>


       
    </div>
</body>
</html>