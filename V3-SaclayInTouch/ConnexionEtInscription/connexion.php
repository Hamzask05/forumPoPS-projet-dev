<?php
session_start();
include("connexionDB.php");
include("loginDB.php");

$email = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $login = new LoginDB();
    $error = $login->evaluate($_POST); 
//puis on verifie qu'il n'y a pas d'erreur
    if ($error == "") {
        header("Location: ../Profil/profil.php");
        exit;
    } else {
        echo $error; // Affiche le message d’erreur
    }
}


?>




<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="styleConnexion.css">
</head>
<body>
<header>
<h1>SaclayInTouch</h1>
<img src="logoParisSaclay.png" id="logoParisSaclay" alt="Logo de l'universiré Paris-Saclay">
</header>

<div id="infosDeConnexion">
  <form method="post" action="">
  <h2>Connecte toi</h2>
  <div id="email">
  <input value="<?php echo $email ?>" type="email" id="email" name="email" placeholder="nom.prénom@universite-paris-saclay.fr">
  </div>
  <div id="mot de passe">
  <input type="password" id="mdp" name="password" placeholder="Mot de passe" maxlength="12">
  </div>
  <br>
  <button id="boutonConnexion">Se connecter</button>  


</form>
</div>

</body>
</html>