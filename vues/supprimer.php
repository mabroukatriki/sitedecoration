<?php
require_once '../persistance/DialogueBD.php';
$undlg = new DialogueBD();
$tableProduit = $undlg->getTousLesProduit();

if (isset($_POST['delete'])) {
    $idProduit = $_POST['idProduit'];
    try {
        $undlg = new DialogueBD();
        $success = $undlg->supprimerProduit($idProduit);
        if ($success) {
            header("location: listerProduit.php");
            exit();
        } else {
            throw new Exception("Erreur lors de la suppression du produit.");
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once 'header.php';?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1> Supprimer des produits </h1>
<div class="container">
    <?php require_once("menu.html"); ?>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID Catégorie </th>
            <th> Nom de Produit </th>
            <th>  Prix  </th>
            <th> ID Produit  </th>
            <th> Description</th>
            <th> Actions </th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($tableProduit as $ligne) {
            $idProd = $ligne['IDPRODUIT'];
            $idCat = $ligne['IDCATEGORIE'];
            $nom = $ligne['NOMPRODUIT'];
            $prixProd = $ligne['PRIXPRODUIT'];
            $descrProd = $ligne['DEDESCRIPTIONPRODUIT'];


            echo "<tr>";
            echo "<td>$idCat</td>";
            echo "<td>$nom</td>";
            echo "<td>$prixProd</td>";
            echo "<td>$idProd</td>";
            echo "<td>$descrProd</td>";
            echo "<td>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='idProduit' value='$idProd'>";

            echo "<button type='submit' name='delete' onclick='return confirmerSuppression()'>Supprimer</button>";
            ;
            echo "</form>";
            echo "</td>";
            echo "</tr>";

        }
        ?>
        <script>
            function confirmerSuppression() {
                return confirm("Êtes-vous sûr de vouloir supprimer ce produit ?");
            }
        </script>

        </tbody>
    </table>
</div>
</body>
</html>





