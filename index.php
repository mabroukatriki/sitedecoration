<html>
<head>
    <title>Sweet&Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="lib/css/style.css" rel="stylesheet">
    <link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="lib/jquery/jquery-2.1.3.min.js"></script
    <script src="lib/bootstrap/js/ui-bootstrap-tpls.js" type="text/javascript"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <link href="index.css" rel="stylesheet">

</head>
<body class="">

<?php
// Démarre la session
session_start();
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie les identifiants et mot de passe
    $userName = $_POST["userName"];
    $password = $_POST["password"];
    if ($userName == "adminsio" && $password == "siosio") {
        // Identifiants valides, stocke le nom d'utilisateur dans la session
        $_SESSION["userName"] = $userName;

        // Partie à modifier
        header("Location: vues/AccueilAdmin.php");
        exit;
    }
    elseif ($userName == "editeursio" && $password == "siosio")
    {
        $_SESSION["userName"] = $userName;

        // Partie à modifier Ici c'est la page vers laquelle tu accede quand tu te connecter
       header("Location: vues/AccueilEdit.php");
        exit;
    }
    else {
        // Identifiants invalides, affiche un message d'erreur
        $errorMessage = "Identifiants invalides";
    }
}

// Affiche le formulaire de connexion
?>

<div class="wrapper">
    <div class="logo">
        <img src="lib/image/decosalon.jpg" alt="salon" width="1000" height="375">

    </div>
</div>

<div class="text-center mt-4 name">Connecter - Vous
</div>
<?php if (isset($errorMessage)) { ?>
    <div class="alert alert-danger"><?= $errorMessage ?></div>
<?php } ?>
<form class="p-3 mt-3" action="index.php" method="post">
    <div class="form-field d-flex align-items-center">
        <span class="far fa-user"></span>
        <input type="text" name="userName" id="userName" placeholder="Identifiant">
    </div>
    <div class="form-field d-flex align-items-center">
        <span class="fas fa-key"></span>
        <input type="password" name="password" id="pwd" placeholder=" Mot de passe">
    </div>
    <button class="btn mt-3">Se connecter</button>
</form>


</body>
