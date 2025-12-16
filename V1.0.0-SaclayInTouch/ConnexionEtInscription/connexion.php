<?php
session_start();
include("connexionDB.php");
include("loginDB.php");

$email = "";
$password = "";
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email == "" || $password == "") {
        $error= "Veuillez remplir tous les champs.";
    } else {
        $login = new LoginDB();
        $res = $login->evaluate($_POST);

        if ($res == "") {
            header("Location: ../Profil/profil.php");
            exit;
        } else {
            $error = $res;
        }
    }
}

?>




<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="styleConnexion2.css">
</head>
<body>
<header>
<h1>SaclayInTouch</h1>
<img src="logoParisSaclay.png" id="logoParisSaclay" alt="Logo de l'universiré Paris-Saclay">
</header>

<div id="infosDeConnexion">
  <form method="post" action="">
  <h2>Connecte toi</h2>
  <?php if ($error != ""): ?>
        <div class="message-erreur">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
  <div id="email">
  <input value="<?php echo $email ?>" type="email" id="email" name="email" placeholder="nom.prénom@universite-paris-saclay.fr" required>
  </div>
  <div id="mot de passe">
  <input type="password" id="mdp" name="password" placeholder="Mot de passe" maxlength="12" required>
  </div>
  <br>
  <button id="boutonConnexion">Se connecter</button>  
  <a href="inscription.php">
  <div id="pasDeCompte">Pas encore de compte ?</div>
    </a>

</form>
</div>

</body>
</html>