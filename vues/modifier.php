<?php
require_once '../persistance/DialogueBD.php';
$undlg = new DialogueBD();
$tableProduit = $undlg->getTousLesProduit();

if (isset($_POST['modifier'])) {
    $IDPRODUIT = isset($_POST['IDPRODUIT']) ? $_POST['IDPRODUIT'] : null;
    $IDCATEGORIE = isset($_POST['IDCATEGORIE']) ? $_POST['IDCATEGORIE'] : null;
    $NOMPRODUIT = isset($_POST['NOMPRODUIT']) ? $_POST['NOMPRODUIT'] : null;
    $PRIXPRODUIT = isset($_POST['PRIXPRODUIT']) ? $_POST['PRIXPRODUIT'] : null;
    $DEDESCRIPTIONPRODUIT = isset($_POST['DEDESCRIPTIONPRODUIT']) ? $_POST['DEDESCRIPTIONPRODUIT'] : null;
    $Image = isset($_POST['Image']) ? $_POST['Image'] : null;

    try {
        $undlg = new DialogueBD();
        $success = $undlg->modifierProduit($IDPRODUIT,$IDCATEGORIE ,$NOMPRODUIT , $PRIXPRODUIT, $DEDESCRIPTIONPRODUIT, $Image);
        if ($success) {
            header("location: listerProduit.php");
        } else {
            throw new Exception("Erreur lors de la modification du produit.");
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue : " . $e->getMessage();
    }
}
?>
<head>
    <?php require_once 'header.php';?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h1> Modifier des produits </h1>
<div class="container">
    <table class="table table-bordered table-striped">
        <?php require_once("menu.html"); ?>
        <thead>
        <tr>
            <th>ID Catégorie </th>
            <th> Nom de Produit </th>
            <th> Prix </th>
            <th> Description </th>
            <th> Image </th>
            <th> Action </th>

        </tr>
        </thead>
        <?php
        foreach ($tableProduit as $ligne) {
            $IDPRODUIT = $ligne['IDPRODUIT'];
            $IDCATEGORIE = $ligne['IDCATEGORIE'];
            $NOMPRODUIT= $ligne['NOMPRODUIT'];
            $PRIXPRODUIT = $ligne['PRIXPRODUIT'];
            $DEDESCRIPTIONPRODUIT = $ligne['DEDESCRIPTIONPRODUIT'];
            $Image = $ligne['Image'];
            ?>
            <tr>
                <form method="post">
                    <td><input type="text" name="IDCATEGORIE" value="<?= $IDCATEGORIE ?>"></td>
                    <td><input type="text" name="NOMPRODUIT" value="<?= $NOMPRODUIT ?>"></td>
                    <td><input type="text" name="PRIXPRODUIT" value="<?= $PRIXPRODUIT?>"></td>
                    <td><input type="text" name="DEDESCRIPTIONPRODUIT" value="<?= $DEDESCRIPTIONPRODUIT ?>"></td>
                    <td> <input type="text" name="Image" value="<?= $Image ?>"></td>
                    <input type="hidden" name="IDPRODUIT" value="<?= $IDPRODUIT ?>">
                    <td><button type="submit" name="modifier">Modifier</button></td>
                </form>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>

