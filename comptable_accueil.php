<?php
require './pdo/Access.php';

session_start();

if (empty($_SESSION) || $_SESSION['Rang'] != 2){
    header('Location: ../');
}
unset($_POST);

include_once './navbar/navbarComp.php';
?>

        <div class="container">
            <div class="row">
                <div class="white-zone2">
                    <h1 class="title-page">Consultation des frais</h1>
                        <div class="table-responsive">
                            <form id="test" action="comptable_validation_frais.php" method="post">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Prénom</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $TabUser = getUserByType(3);
                                    foreach ($TabUser as $data){
                                    ?>
                                        <tr>
                                            <td><a href="comptable_validation_frais.php?mois=<?php echo (int)date('m')-1; ?>&param1=<?php echo $data['Id'] ?>"><?php echo $data['Nom'] ?></a></td>
                                            <td><a href="comptable_validation_frais.php?mois=<?php echo (int)date('m')-1; ?>&param1=<?php echo $data['Id'] ?>"><?php echo $data['Prenom'] ?></a></td>
                                            <td>
                                                <a class="icon1" href="comptable_validation_frais.php?mois=<?php echo (int)date('m')-1; ?>&param1=<?php echo $data['Id'] ?>" title="Consulter"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                </div>
            </div>
        </div>

        <script defer src="js/fontawesome/svg-with-js/js/fontawesome-all.js"></script>
        <script type="text/javascript" src="plugins/jquery.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>