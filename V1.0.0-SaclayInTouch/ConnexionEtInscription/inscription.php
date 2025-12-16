<?php
include("connexionDB.php");
include("InscriptionDB.php"); 
// il est important d inclure les deux, InscriptionDB se repose fortement sur connexionDB
$prenom ="";
$nom ="";
$dateDeNaissance="";
$email ="";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);// sert à comprendre la source des erreurs et déboguer
//très utile

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inscription = new InscriptionDB();
    $result = $inscription->evaluate($_POST);
    //echo $result; // à enlever par la suite mais pr la suite c est utile pour voir nos 
    // requetes
// la fct isset permet de vérifier si la valeur est nulle ou non 
// si elle est nulle "" sera attribué aux variables
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $dateDeNaissance = isset($_POST['dateDeNaissance']) ? $_POST['dateDeNaissance'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
      header("Location: connexion.php");
      die;
}



?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="styleInscription1.css">
</head>

<body>
  <header>
    <h1>SaclayInTouch</h1>
  </header>

  <div id="infosDeConnexion">
    <form method="post" action="">
      <h2>S'inscrire</h2>
      <div id="infoPersonnes">

        <input value="<?php echo $prenom ?>" type="text" id="prénom" name="prenom" placeholder="Prénom">
        <br>
        <input value="<?php echo $nom ?>" type="text" id="nom" name="nom" placeholder="Nom">
        <br>
        <input type="date" id="anneeDeNaissance" name="dateDeNaissance">

        <div id="composantePS">
          <select id="composante" name="composante">
            <option value="">-- Choisir une composante --</option>
            <option value="PS">Composante Paris-Saclay</option>
            <option value="PLY">Polytech Paris-Saclay</option>
            <option value="CS">CentraleSupélec</option>
            <option value="ENS">ENS Paris-Saclay</option>
            <option value="UVSQ">UVSQ</option>
            <option value="STAPS">STAPS</option>
            <option value="HM">Henri Moissan</option>
          </select>

        </div>

      </div>
      <div id="email">
        <input value="<?php echo $email ?>" type="email" id="email" name="email" placeholder="nom.prénom@universite-paris-saclay.fr">
      </div>
      <div id="mot de passe">
        <input type="password" id="mdp" name="password" placeholder="Mot de passe" maxlength="12">
        <br>
        <input type="password" id="mdp2" name="password2" placeholder="Confirmer le Mot de passe" maxlength="12">

      </div>
      <br>
      <input type="submit" id="soumettre">

    </form>
    <a href="connexion.php" id="dejaUnCompte"> Déja un compte ?</a>
  </div>

</body>

</html>