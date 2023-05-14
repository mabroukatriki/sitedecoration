<?php
require_once '../persistance/DialogueBD.php';

$undlg = new DialogueBD();
$tableCategorie = $undlg->getCategorie();
if (isset($_POST['categorie']) && isset($_POST['NOMPRODUIT']) && isset($_POST['PRIXPRODUIT']) && isset($_POST['DEDESCRIPTIONPRODUIT']) && isset($_FILES['Image'])) {
    try {
        $IDCATEGORIE = $_POST['categorie'];
        $NOMPRODUIT = $_POST['NOMPRODUIT'];
        $PRIXPRODUIT = $_POST['PRIXPRODUIT'];
        $DEDESCRIPTIONPRODUIT = $_POST['DEDESCRIPTIONPRODUIT'];

        if (isset($_FILES['Image']) && $_FILES['Image']['name']) {
            $valid_extensions = array("jpg", "jpeg", "png", "gif");
            $extension = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $valid_extensions)) {
                throw new Exception("Extension de fichier invalide.");
            }
            $target_dir = "../image/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . basename($_FILES['Image']['name']);
            if (!move_uploaded_file($_FILES['Image']['tmp_name'], $target_file)) {
                throw new Exception("Erreur lors du téléchargement de l'image.");
            }
            $image_path = $target_file;
        } else {

            $image_path = $_POST['old_image_path'];
        }
        $ajoutOK = $undlg-> AjouterProduit($IDCATEGORIE, $NOMPRODUIT, $PRIXPRODUIT, $DEDESCRIPTIONPRODUIT,$image_path);
        if ($ajoutOK) {
            header("location: listerProduit.php");
        } else {
            echo "Erreur lors de la modification .";
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue: " . $e->getMessage();
    }
}
?>

<head>
    <?php require_once ("header.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body class="body">
<?php require_once("menu.html"); ?>
<h1> Ajouter un produit </h1>
<div class="well">
    <form class="form-horizontal" enctype="multipart/form-data" role="form" name="mangaForm" action="ajouterProduit.php" method="POST">

        <div class="form-group">
            <label class="col-md-3 control-label"> ID Categorie :</label>
            <div class="col-md-3">
                <select name="categorie" class="form-control">
                    <?php
                    foreach ($tableCategorie as $categorie){
                        $idcat=$categorie['IDCATEGORIE'];
                        $nom=$categorie['NOMCATEGORIE'];
                        echo "<option value='$idcat'>$nom</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"> Nom de Produit  :</label>
            <div class="col-md-3">
                <input type="text" name="NOMPRODUIT" class="form-control" required autofocus>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label"> Prix :</label>
            <div class="col-md-3">
                <input type="text" name="PRIXPRODUIT" class="form-control" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"> Description :</label>
            <div class="col-md-3">
                <input type="text" name="DEDESCRIPTIONPRODUIT" class="form-control" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label"> Image :</label>
            <div class="col-md-3">
                <input type="file" name="Image" class="form-control" required autofocus>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-ok"></span> Valider</button>
                &nbsp;
                <button type="button" class="btn btn-default btn-primary" onclick="javascript:window.location='ajouterProduit.php';"><span class="glyphicon glyphicon-remove"></span> Retour</button>
            </div>
        </div>
    </form>
</div>
</body>