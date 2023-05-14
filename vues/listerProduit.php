<!DOCTYPE>
<html>
<?php
require_once '../persistance/DialogueBD.php';

try {
    $undlg = new DialogueBD();
    $tableProduit = $undlg->getTousLesProduit();
} catch (Exception $e) {
    $erreur = $e->getMessage();
}
?>
<head>
    <?php require_once 'header.php';?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ajout des icônes pour les actions -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<h1>Liste des produits</h1>
<div class="container">
    <table class="table table-bordered table-striped">
        <?php require_once("menu.html"); ?>
        <thead>
        <tr>
            <th> ID Produit  </th>
            <th>ID Catégorie </th>
            <th> Nom de Produit </th>
            <th>  Prix  </th>
            <th> Description</th>
            <th> Image </th>



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


            $image_path = '../lib/image/' . $ligne['Image'];
            echo "<tr>
        <td>$idProd</td>
        <td>$idCat</td>
        <td>$nom</td>
        <td>$prixProd</td>
        <td>$descrProd</td>
        <td><img src=\"$image_path\" width='200px'></td>
        
     </tr>";


        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
