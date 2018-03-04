<?php

session_start();

if (empty($_SESSION) || $_SESSION['Rang'] != 3){
    header('Location: ./index.php');
}

include_once "./navbar/navbarVisi.php"
?>


        <div class="container">
            <div class="row">
                <div class="white-zone2">
                    <h1 class="title-page">Bienvenue</h1>
                    <div class="container">
                            <div class="row"><div class="nav-link">Pour commencer à saisir une visite forfaitisé, cliquez</div> <a class="nav-link" href="visiteur_frais_forfaitises.php">ici</a></div><br>
                            <div class="row"><div class="nav-link">Pour commencer à saisir une visite non forfaitisé, cliquez</div> <a class="nav-link" href="visiteur_frais_hors_forfait.php">ici</a></div><br>
                            <div class="row"><div class="nav-link">Pour télécharger l'application mobile permettant la saisie de visite, cliquez</div> <a  class="nav-link" onclick="window.location='apk/suiviAA.apk'" href="#">ici</a></div><br>
                    </div>
                </div>
            </div>
        </div>

		<script type="text/javascript" src="plugins/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	</body>
</html>