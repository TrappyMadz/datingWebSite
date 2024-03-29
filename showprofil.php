<?php
session_start();
include 'nonAccessiblePhpPages/bdd.php';
if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}
if (isset($_GET['pseudo'])) {
    $username = $_GET['pseudo'];
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

    $session_username = $_SESSION['username'];
    $query_session_user_id = "SELECT id FROM utilisateurs WHERE pseudo = '$session_username'";
    $result_session_user_id = $conn->query($query_session_user_id);

    if ($result_session_user_id->num_rows > 0) {
  
        $row_session_user_id = $result_session_user_id->fetch_assoc();
        $session_user_id = $row_session_user_id['id'];

        $get_username = $_GET['pseudo'];
        $query_get_user_id = "SELECT id FROM utilisateurs WHERE pseudo = '$get_username'";
        $result_get_user_id = $conn->query($query_get_user_id);

        if ($result_get_user_id->num_rows > 0) {

            $row_get_user_id = $result_get_user_id->fetch_assoc();
            $get_user_id = $row_get_user_id['id'];

            if ($result_check_existing_user->num_rows == 0) {

                $query_check_existing_user = "SELECT id FROM vus WHERE id = '$get_user_id'";
                $result_check_existing_user = $conn->query($query_check_existing_user);

                $query_get_liste_id = "SELECT liste_id FROM vus WHERE id = '$get_user_id'";
                $result_get_liste_id = $conn->query($query_get_liste_id);
                $row_liste_id = $result_get_liste_id->fetch_assoc();
                $liste_id = $row_liste_id['liste_id'];

                $existing_list_array = explode(',', $liste_id);
                $is_in_array = in_array($session_user_id,$existing_list_array);


                if(($list_id==NULL&&$result_check_existing_user->num_rows == 0)){

                    $sql_update = "INSERT INTO vus (id, liste_id) VALUES ('$get_user_id', '$session_user_id')";
                    $conn->query($sql_update);
                }else if (!$is_in_array){

                    $sql_update = "UPDATE vus SET liste_id = CONCAT_WS(',', liste_id, '$session_user_id') WHERE id = '$get_user_id'";
                    $conn->query($sql_update);
                }
            }
        } else {
            echo "L'utilisateur spécifié dans l'URL n'existe pas.";
        }
    }
}
?>

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
            echo '<img src="'.$url.'" width="200em">';
            echo '<p>'.$name.' '.$surname.'</p>';
            echo '<p>'.$city.'</p>';
        ?>
        <br><br><br>


       
    </div>
</body>
</html>