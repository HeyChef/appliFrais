<?php
require './pdo/ficheFrais.php';

session_start();

setlocale (LC_TIME, 'fr_FR.utf8','fra');

if (empty($_SESSION) || $_SESSION['Rang'] != 3){
    header('Location: ./index.php');
}
if(isset($_POST['AjoutFraisHF']))
{
    $orderdate = explode("-",$_POST['date_depense_fraisf']);
    $month = $orderdate[1];

    if((int)$month == (int)date("m")-1)
    {
        $fiche = array();
        $fiche['MontantValide'] = (int)$_POST['montant_fraishf'];
        $fiche['Date'] = $_POST['date_depense_fraisf'];

        $fraisf = array();
        $fraisf['Desc'] = $_POST['description_fraishf'];
        $fraisf['Date_Depense'] = $_POST['date_depense_fraisf'];
        $fraisf['Montant'] = (int)$_POST['montant_fraishf'];
        $fraisf['nb_justificatifs'] = 0;
        insertFiche($fiche, $fraisf, false);

        $message='Fiche frais hors forfait ajouté !';
        echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
    }
    if((int)$month !== (int)date("m")-1)
    {
        $message='Merci de renseigner les frais du mois précédent.';
        echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
    }
}if (isset($_POST['idToDel'])){
    deleteFicheF_HF($_SESSION['Id'],$_POST['idToDel'],true);

}

$mois = (int)date('m') - 1;
unset($_POST);

include './navbar/navbarVisi.php';
?>

        <div class="container">
            <div class="row">
                <div class="white-zone2">
                    <form action="fpdf/pdfphpvisitehorsforfait.php" name="valider" >
                        <h1 class="title-page">Frais hors forfait</h1>
                        <?php
                        $tabUser = donneepdf($_SESSION['Id']);
                        ?>
                        <a target="blank" class="icon2" href=./fpdf/pdfphpvisitehorsforfait.php?mois=<?php echo $mois; ?>&id=<?php echo $_SESSION['Id'] ?>" title="Télécharger au format PDF"><i class="far fa-file-pdf"></i></a>
                        <a class="link-modal" href="" data-toggle="modal" data-target="#Modalfraihf"><p>Ajouter un frais hors forfait</p></a>

                    </form>
                    <p style="margin-left: 20px">Veuillez saisir les fiches de frais hors forfait du mois de <?php echo (strftime("%B %Y", strtotime('-1 month')));  ?></p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Libellé</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $data = selectFiche($_SESSION['Id'],true,$mois);
                                if(isset($data)){
                                    foreach ($data as $tab){
                            ?> 
                                <tr>
                                    <td><?php echo $tab['Date'] ?></td>
                                    <td><?php echo $tab['Desc'] ?></td>
                                    <td><?php echo $tab['Montant'] ?></td>
                                    <td>
                                        <form method="post" action="">
                                            <button class="icon2" href="" type="submit" title="Supprimer" name="idToDel" value="<?php echo $tab['Id'] ?>"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }}else{
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

        <div class="modal fade" id="Modalfraihf" tabindex="-1" role="dialog" aria-labelledby="Modalinscription" aria-hidden="true">
            <form action="" method="post" name="AjoutFraisHF">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 id="modal-title" class="modal-title">Ajout frais hors forfait</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="date_depense_fraisf" placeholder="Date d'embauche" required=""/>
                                    <input type="text" class="form-control" name="description_fraishf" aria-describedby="Libellé" placeholder="Libellé">
                                    <input type="text" class="form-control" name="montant_fraishf" aria-describedby="Montant" placeholder="Montant">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="AjoutFraisHF" class="btn btn-primary">Valider</button>
                        </div>
                    </div>
                </div>
         </form>
        </div>


        <script defer src="js/fontawesome/svg-with-js/js/fontawesome-all.js"></script>
		<script type="text/javascript" src="plugins/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	</body>
</html>