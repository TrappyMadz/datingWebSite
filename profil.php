<?php
session_start();
include 'nonAccessiblePhpPages/bdd.php';


if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}

$username = $_SESSION['username'];

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
$statut = $row['statut'];
$id = $row['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
        include 'nonAccessiblePhpPages/header.php';
    ?>

    <div class="Page_Principale">

    <?php
    if ($statut == 'abonne' || $statut == 'admin') {
        echo "<h2>Les utilisateurs ayant consulté votre profil</h2>";
        echo '<ul class="user-list">';
        $query = "SELECT liste_id FROM vus WHERE id = '$id'";
        $result = $conn->query($query);

        if ($result) {

            while ($row = $result->fetch_assoc()) {
                $liste_id = $row['liste_id'];
                $liste_id_array = explode(',', $liste_id);
                foreach ($liste_id_array as $id) {
                    $user_query = "SELECT pseudo, lien FROM utilisateurs WHERE id = '$id'";
                    $user_result = $conn->query($user_query);
                    $user_row = $user_result->fetch_assoc();
                    $pseudo = $user_row['pseudo'];
                    $lien = $user_row['lien'];
                    echo  '<div class="profil"><a href="showprofil.php?pseudo='.$pseudo.'"><img src="'.$lien.'" width="80em"></a><p>'.$pseudo.'</p></div> <br>';
                }
            }
        }
        echo '</ul>';
    }
    ?>
        <br><h2>Votre profil</h2>
        <?php
            $sql = "SELECT lien FROM utilisateurs WHERE pseudo = '$username'";
            $resultat = $conn->query($sql);
            $row = $resultat->fetch_assoc();
            $url = $row['lien'];
            echo '<img src="'.$url.'" width="200em">';
        ?>
        <br><br>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="formprofil">
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
            <button type="button" id="toggleButton" onclick="togglePassword()"><img src="img/oeil.jpg"></button>

            <input type="submit" class="btn" value="Valider les changements">

        </form><br><br>

    </div>
</body>
</html>