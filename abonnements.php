<?php
session_start();
include 'nonAccessiblePhpPages/bdd.php';

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
	<link rel="stylesheet" type="text/css" href="css/styleAbo.css" />
	<meta name="author" content="LAKOMICKI ROBLES CHARRIER CARRIAC" />
	<meta charset="utf-8">
</head>

<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
            if (isset($_POST['tarif'])) {
                $tarif = $_POST['tarif'];
                switch ($tarif) {
                    case 'Tarif1':
                        $date_fin_interval = '+1 month';
                        break;
                    case 'Tarif2':
                        $date_fin_interval = '+3 months';
                        break;
                    case 'Tarif3':
                        $date_fin_interval = '+1 year';
                        break;
                    default:
                
                        $date_fin_interval = null;
                        break;
                }
            }

            $username = $_SESSION['username'];
            $query_user_id = "SELECT id FROM utilisateurs WHERE pseudo = '$username'";
            $result_user_id = $conn->query($query_user_id);

            if ($result_user_id->num_rows > 0) {
                $row = $result_user_id->fetch_assoc();
                $user_id = $row["id"];

        
                $query_existing_subscription = "SELECT * FROM abonnements WHERE id = '$user_id'";
                $result_existing_subscription = $conn->query($query_existing_subscription);

                if ($result_existing_subscription->num_rows > 0) {
            
                    $row_existing = $result_existing_subscription->fetch_assoc();
                    $current_date_fin = $row_existing["date_fin"];
                    $new_date_fin = date('Y-m-d', strtotime($current_date_fin . ' ' . $date_fin_interval));
                    $sql = "UPDATE abonnements SET date_fin = '$new_date_fin' WHERE id = '$user_id'";
                } else {
            
                    $sql = "INSERT INTO abonnements (id, date_debut, date_fin) VALUES ('$user_id', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 MONTH))";
                }

                $sql_update_user = "UPDATE utilisateurs SET statut = 'abonne' WHERE pseudo = '$username'";

                if ($conn->query($sql) === TRUE && $conn->query($sql_update_user) === TRUE) {
                    echo "Abonnement réussi !";
                } else {
                    echo "Erreur lors de l'abonnement : " . $conn->error;
                }
            }
        }
    ?>
    
    <?php
        // Menu :
        include 'nonAccessiblePhpPages/header.php';
    ?>
    

    <h1> Abonnez-vous et gagnez de nombreux avantages ! </h1>
    <p> Envoyez des messages à vos coup de moteur</p>
    <p> Soyez au courant des voitures qui sont passées sur votre profil</p>
    <div class="Page_Principale">
        <br>
        <div id="cote">
        <?php
            if ($statut == 'abonne') {

            $query_user_id = "SELECT id FROM utilisateurs WHERE pseudo = '$username'";
            $result_user_id = $conn->query($query_user_id);
    
                if ($result_user_id->num_rows > 0) {
                    $row_user_id = $result_user_id->fetch_assoc();
                    $user_id = $row_user_id['id'];

                    $sql = "SELECT date_fin FROM abonnements WHERE id = '$user_id'";
                    $resultat = $conn->query($sql);

                    if ($resultat->num_rows > 0) {
                        $row = $resultat->fetch_assoc();
                        $date_fin = $row['date_fin'];
                        echo '<div id="current_abo">';
                        echo "<p>Vous êtes actuellement abonné jusqu'au ".$date_fin."</p>";
                        echo '</div>';
                    } else {
                        echo "Aucun abonnement trouvé pour cet utilisateur.";
                    }
                }
            }
        ?>

            <div class="container">
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="radio-toolbar">
                        <input type="radio" id="radioTarif1" name="tarif" value="Tarif1" checked>
                        <label for="radioTarif1">1 mois<br>5€</label>

                        <input type="radio" id="radioTarif2" name="tarif" value="Tarif2">
                        <label for="radioTarif2">3 mois<br>13€</label>

                        <input type="radio" id="radioTarif3" name="tarif" value="Tarif3">
                        <label for="radioTarif3">1 an<br>50€</label>
                    </div>
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
                    <input type="number" id="ccnum" name="cardnumber" required>
                    <label for="exp">Date expiration</label>
                    <input type="month" id="exp" name="exp" required>
                    <label for="cvv">CVV</label>
                    <input type="number" id="cvv" name="cvv" required>
                    <input type="submit" value="Payer" class="btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
