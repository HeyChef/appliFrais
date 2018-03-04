<?php
require './pdo/Access.php';

session_start();
setlocale (LC_TIME, 'fr_FR.utf8','fra');
date_default_timezone_set('UTC');
$cumul = 0;

if (isset($_GET['mois'])){
    $MoisAffiche = $_GET['mois'];
}

if (empty($_SESSION) || $_SESSION['Rang'] != 2){
    header('Location: ./index.php');

}
if (isset($_POST['idToVal'])){
   modifierEtatFicheFrais($_POST['Mois'],$_SESSION['User'],'VA');
}


if (isset($_POST['idToDel'])){
    deleteFicheF_HF($_SESSION['User'],$_POST['idToDel'],false);
}

if (isset($_POST['CMois'])){
    $MoisAffiche = $_POST['CMois'];
}

if (isset($_POST['Validation'])){
    modifierEtatFicheFrais($_SESSION['MoisFiche'],$_GET['param1'],'VA');
}

unset($_POST); 

include './navbar/navbarComp.php';
?>

        <div class="container">
            <div class="row">
                <div class="white-zone2">
                    <form action="pdfphp.php" name="valider" >
                        <h1 class="title-page">Validation des frais</h1>

                        <?php
                        $_SESSION['id']=$_GET['param1'];
                        $tabUser = getUserById($_SESSION['id']);
                        ?>
                        <a class="icon2" href="http://localhost/PPE/PPE-Web/fpdf/pdfphp.php?mois=<?php echo $MoisAffiche; ?>&id=<?php echo $_SESSION['id'] ?>" title="Télécharger au format PDF"><i class="far fa-file-pdf"></i></a>

                    </form>
                    <p style="margin-left: 20px">Ensemble des frais du mois de <?php echo strftime("%B", mktime(0, 0, 0, $MoisAffiche, 10));  ?></p>
                   
                    <div class="info">
                        <?php
                            $tabUser = getUserById($_GET['param1']);
                            $_SESSION['User'] = $tabUser['Nom']
                        ?>
                        <p>Nom : <?php echo $tabUser['Nom']; ?></p>
                        <p>Prenom : <?php echo $tabUser['Prenom']; ?></p>
                        <p>Adresse :<?php echo $tabUser['Adresse']; ?></p>
                        <p class="info2">CP : <?php echo $tabUser['CodePostale']; ?></p>
                        <p class="info2">Ville :<?php echo $tabUser['Ville']; ?></p>
                        <p>Téléphone : <?php echo $tabUser['Telephone']; ?></p>
                        <p>email : <?php echo $tabUser['Email']; ?></p>
                    </div>
                    <div>
                        <form action="" method="post" name="ChangMois">
                            <div class="form-group" style="display: inline-flex; float: right; margin-right: 5%">    
                                <select name="CMois" class="form-control" id="mois" style="margin-right: 10%">
                                    <option class="mois" value="01"selected>Janvier</option> 
                                    <option class="mois" value="02">Février</option> 
                                    <option class="mois" value="03">Mars</option> 
                                    <option class="mois" value="04">Avril</option> 
                                    <option class="mois" value="05">Mai</option> 
                                    <option class="mois" value="06">Juin</option> 
                                    <option class="mois" value="07">Juillet</option> 
                                    <option class="mois" value="08">Aout</option> 
                                    <option class="mois" value="09">Septembre</option> 
                                    <option class="mois" value="10">Octobre</option> 
                                    <option class="mois" value="11">Novembre</option> 
                                    <option class="mois" value="12">Décembre</option>
                                </select>
                                <button class="btn btn-primary">Valider</button>
                            </div>
                        </form>
                    </div>
                    
                    <form action="" method="post" name="ModifEtatFicheFrais">               
                        <button class="btn btn-success" name="Validation" value="VA" style="margin-left: 4%">Valider Fiche</button>
                        <?php $_SESSION['MoisFiche'] = $MoisAffiche; ?>
                    </form>

                    <h2 class="title-page2">Ensemble des Frais du mois :</h2>
                    <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Forfait étape</th>
                                        <th scope="col">Frais kilométrique</th>
                                        <th scope="col">Nuitée hôtel</th>
                                        <th scope="col">Repas restaurant</th>
                                    </tr>
                                </thead>    
                                <tbody>
                                <tr>
                                    <td>Quantité totale</td>
                                    <td>
                                        <?php
                                        $data = selectFicheByType($_GET['param1'],'ETP',$MoisAffiche);
                                        echo $data['Qte'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $data = selectFicheByType($_GET['param1'],'KM',$MoisAffiche);
                                        echo $data['Qte'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $data = selectFicheByType($_GET['param1'],'NUI',$MoisAffiche);
                                        echo $data['Qte'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $data = selectFicheByType($_GET['param1'],'REP',$MoisAffiche);
                                        echo $data['Qte'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Montant total</td>
                                    <td>
                                        <?php
                                        $data = selectFicheByType($_GET['param1'],'ETP',$MoisAffiche);
                                        $cumul += $data['Montant'];
                                        echo $data['Montant'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $data = selectFicheByType($_GET['param1'],'KM',$MoisAffiche);
                                        $cumul += $data['Montant'];
                                        echo $data['Montant'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $data = selectFicheByType($_GET['param1'],'NUI',$MoisAffiche);
                                        $cumul += $data['Montant'];
                                        echo $data['Montant'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $data = selectFicheByType($_GET['param1'],'REP',$MoisAffiche);
                                        $cumul += $data['Montant'];
                                        echo $data['Montant'];
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    <h2 class="title-page2">Frais forfaitisés du mois :</h2>
                    <div class="row">
                        <div class="table-responsive">
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Type de frais</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Quantité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $data2 = selectFiche($_GET['param1'],false,$MoisAffiche);
                                        if(isset($data2)){
                                            foreach ($data2 as $tab){
                                        ?>
                                        <tr>
                                            <td><?php echo $tab['Date_Dep']?></td>
                                            <td><?php echo $tab['Id_Type'] ?></td>
                                            <td><?php echo $tab['Desc'] ?></td>
                                            <td><?php echo $tab['Qte'] ?></td>
                                        </tr>
                                        <?php }
                                        }else{
                                            ?> 
                                            
                                            <td>vide</td>
                                            <td>vide</td>
                                            <td>vide</td>
                                            <td>vide</td> <?php
                                        } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h2 class="title-page2">Frais hors forfait du mois :</h2>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Libellé</th>
                                        <th scope="col">Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $data = selectFiche($_GET['param1'],true,$MoisAffiche);
                                if(isset($data)){
                                    foreach ($data as $tab){
                                        ?>
                                        <tr>
                                            <td><?php echo $tab['Date'] ?></td>
                                            <td><?php echo $tab['Desc'] ?></td>
                                            <td><?php echo $tab['Montant'] ?></td>
                                            </td>
                                        </tr>
                                    <?php }
                                }else{
                                    ?>
                                    <td>vide</td>
                                    <td>vide</td>
                                    <td>vide</td>
                                    <?php
                                
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script defer src="js/fontawesome/svg-with-js/js/fontawesome-all.js"></script>
		<script type="text/javascript" src="plugins/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	</body>
</html>