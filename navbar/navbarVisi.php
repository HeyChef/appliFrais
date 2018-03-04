
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.ico">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
            <a class="navbar-brand" href="visiteur_accueil.php">
                <img class="logo-nav" src="img/logo.png" alt="GSB">
            </a>
            <p class="app-frais">Application Frais</p>
                <div class="nav-item active">
                    <a class="" href="visiteur_accueil.php">Accueil <span class="sr-only">(current)</span></a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="visiteur_frais_forfaitises.php">Frais forfaitisés</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="visiteur_frais_hors_forfait.php">Frais hors forfait</a>
                </div>
            <div class="nav-item" onclick="window.location='apk/suiviAA.apk'"><a class="nav-link" href="#">Télécharger l'application androïd</a></div>

            <div class="navbar-toggler collapsed" data-toggle="collapse" data-target="#collapsingNavbar">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['Nom'].' '.$_SESSION['Prenom'] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="pdo/Disconnect.php">Déconnexion</a>
                    </div>
                </div>
            </div>
        </nav>
    <body>