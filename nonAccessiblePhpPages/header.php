
<header> <!-- Le menu du haut :  -->

        <!-- Brand icon of our website : -->
        <a href="accueil.php" title="Menu">
            <img id="logoHeader" alt="logo" src="img/logo.png" width="80em">
        </a>

        <h2> Pistons & Passions </h1>

        <nav class="NavMenu">
            <a href="accueil.php">MENU</a>

            <?php
                include 'nonAccessiblePhpPages/bdd.php';
                $username = $_SESSION['username'];
                $sql = "SELECT statut FROM utilisateurs WHERE pseudo = '$username'";
                $resultat = $conn->query($sql);
                $row = $resultat->fetch_assoc();
                $statut = $row['statut'];
                if ($statut == 'admin') {
                    echo '<a href="adminPage.php">ADMINISTRATION</a>';
                }
                else {
                    echo '<a href="abonnements.php">ABONNEMENTS</a>';
                }

                ?> 
            <a href="profil.php">MON PROFIL</a>
        </nav>

        <?php
            $username = $_SESSION['username'];
            $sql = "SELECT statut FROM utilisateurs WHERE pseudo = '$username'";
            $resultat = $conn->query($sql);
            $row = $resultat->fetch_assoc();
            $statut = $row['statut'];
            if ($statut == 'abonne' || $statut == 'admin') {
                echo '<a href="messagerie.php">
                        <img id="logoMess" alt="Messagerie" src="img/envelope.png" width="45em">
                    </a>';
            }
        ?>

        <a href="nonAccessiblePhpPages/deconnexion.php" class="bouton">DÉCONNEXION</a>
</header>