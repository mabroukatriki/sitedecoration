<?php

require_once '../persistance/DialogueBD.php';


try {
    $undlg = new DialogueBD();
    $tableUtilisateur = $undlg->getTousLesUtilisateur();
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
        <?php require_once("menuEdit.html"); ?>
        <thead>
        <tr>
            <th>ID Utilisateur </th>
            <th> Nom  </th>
            <th>  Email  </th>
            <th> Mots de passe   </th>
            <th> Modifier </th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($tableUtilisateur as $ligne) {
            $id_utilisateur= $ligne['IDUTILISATEUR'];
            $nom_utilisateur = $ligne['NOMUTILISATEUR'];
            $email = $ligne['EMAILUTILISATEUR'];
            $motsdepasse= $ligne['MOTDEPASSE'];



            echo "<tr><td>$id_utilisateur</td><td>$nom_utilisateur</td><td>$email</td><td>$motsdepasse</td>";
            // Ajout des icônes pour les actions
            echo "<td> <a href='ModifEdit.php?id=$id_utilisateur'><i class='fas fa-edit'></i></a></td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>