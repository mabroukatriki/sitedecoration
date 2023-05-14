<?php
require_once '../persistance/DialogueBD.php';
require_once("menuEdit.html");

$undlg = new DialogueBD();
try {
    $tableUtilisateur = $undlg->getTousLesUtilisateur();
} catch (Exception $e) {
    echo "Une erreur est survenue: " . $e->getMessage();
}

if (isset($_POST['modifier'])) {
    try {
        $id_utilisateur = $_POST['IDUTILISATEUR'];
        $nom_utilisateur = $_POST['NOMUTILISATEUR'];
        $email = $_POST['EMAILUTILISATEUR'];
        $motsdepasse = $_POST['MOTDEPASSE'];
        $ajoutOK = $undlg-> modifUtilisateur($id_utilisateur, $nom_utilisateur, $email, $motsdepasse);
        if ($ajoutOK) {
            header("location: listerUtilisateur.php");
            exit(); // Terminer le script après une redirection
        } else {
            echo "Erreur lors de la modification.";
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue: " . $e->getMessage();
    }
}

?>

<head>
    <?php require_once 'header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Modifier la table utilisateur</h1>
<div class="container">
    <?php require_once("menuEdit.html"); ?>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID Utilisateur</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Mots de passe</th>
            <th>Modifier</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($tableUtilisateur as $ligne) {
            $id_utilisateur = $ligne['IDUTILISATEUR'];
            $nom_utilisateur = $ligne['NOMUTILISATEUR'];
            $email = $ligne['EMAILUTILISATEUR'];
            $motsdepasse = $ligne['MOTDEPASSE'];
            ?>
            <tr>
                <form method="post">
                    <td><input type="text" name="IDUTILISATEUR" value="<?= $id_utilisateur ?>"></td>
                    <td><input type="text" name="NOMUTILISATEUR" value="<?= $nom_utilisateur ?>"></td>
                    <td><input type="text" name="EMAILUTILISATEUR" value="<?= $email ?>"></td>
                    <td><input type="text" name="MOTDEPASSE" value="<?= $motsdepasse ?>"></td>
                    <td><button type="submit" name="modifier">Modifier</button></td>
                </form>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
