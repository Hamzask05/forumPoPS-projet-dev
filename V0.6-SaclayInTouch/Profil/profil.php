<?php
session_start();

// 1. EMPÊCHER LE CACHE DU NAVIGATEUR (Pour le bouton retour)
// Cela dit au navigateur : "Ne garde jamais cette page en mémoire, redemande-la au serveur à chaque fois"
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include("../ConnexionEtInscription/connexionDB.php");
include("../ConnexionEtInscription/loginDB.php");
include("user.php");
include("postDB.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. VÉRIFICATION DE SÉCURITÉ
// Si la variable de session n'existe PAS, on redirige et on arrête tout.
$login = new LoginDB();
$user_data = $login->check_login($_SESSION["saclay_userid"]);
//print_r($_SESSION);
$id = $_SESSION["saclay_userid"];
$login = new LoginDB();
$est_connecte = $login->check_login($id);
if ($est_connecte == false) {
  header("Location: ../ConnexionEtInscription/connexion.php");
  die();
}

// Traitement de la création de posts.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $post = new Post();
  $result = $post->create_post($id, $_POST);

  if ($result == "") {

    header("Location: profil.php");
    exit();


  } else {
    echo $result;


  }

}
// récupération des posts 

$mesPosts = new Post();
$ListePosts = $mesPosts->get_posts($id);

// recuperer des amis 
$user = new user();
$id = $_SESSION['saclay_userid'];
$friends = $user->get_friends($id);





?>




<!doctype html>
<html lang="fr" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <title>Profil</title>
  <link rel="stylesheet" href="Profil1.css">

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
  <meta name="generator" content="Astro v5.13.2" />
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbars/" />
  <script src="../assets/js/color-modes.js"></script>
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <meta name="theme-color" content="#712cf9" />
  <link href="navbars.css" rel="stylesheet" />
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>
  <header>
  </header>
  <!--Source du code de base de la navbar: Bootstrap-->
  <?php
  include('header.php');
  ?>
  <!--Fin du code de la nav-->

  <!--Couverture et Profil-->
  <div id="Couverture">
    <div id="CouvertureContenu">
      <img src="../Images/PolytechParisSaclay.jpeg" id="imagePolytech" alt="Photo de couverture Polytech Paris-Saclay">
      <span>
        <a href="profil_image_change.php">
          <?php 
          $image = "imagesParDefaut/imageDefaut.webp";
          if(file_exists($user_data['profil_image'])){
            $image = $user_data['profil_image'];
          }
          ?>
          <img src="<?php echo $image ?>" id="photoDeProfil" alt="Photo de Profil">
          
        </a>
      </span>
      <br>
      <?php echo $user_data['prenom'] . " " . $user_data['nom'] ?>
      <!--Ci dessus on récupère le nom et le prénom de manière automatique dépendamment de l'utilisateur connecté-->

      <br>
      <div id="OptionProfil">
        <a href="">À propos</a> <a href="">Amis</a> <a href="">Paramètres</a>
      </div>
    </div>
    <!--Liste des Amis, écrire un post et voir les posts-->

    <div id="contenant">

      <!--Liste des Amis-->

      <div id="EspacesAmis">
        <div id="listeAmis">
          Amis<br>
          <div id="nomsEtPhotos">
            <div id="Ami1">
              <img src="PhotoAmis/PhotoMehdi.jpeg" id="photoAmi1">
              <span id="ami2">Mehdi Serraj</span>
            </div>
            <div id="Ami2">
              <img src="PhotoAmis/PhotoMehdi.jpeg" id="photoAmi1">
              <span id="ami2">Mehdi Serraj</span>
            </div>
            <div id="Ami3">
              <img src="PhotoAmis/PhotoMehdi.jpeg" id="photoAmi1">
              <span id="ami3">Mehdi Serraj</span>
            </div>
            <div id="Ami4">
              <img src="PhotoAmis/PhotoMehdi.jpeg" id="photoAmi1">
              <span id="ami4">Mehdi Serraj</span>
            </div>

          </div>
        </div>

      </div>
      <!--Post Perso Creation-->
      <div id="box">
        <div id="posts">

          <form method="post">
            <textarea name="post" placeholder="Quoi de neuf ?"></textarea>
            <input id="postBouton" type="submit" value="Publier">
            <br>
        </div>
        </form>
        <!--Posts-->
        <div id="barrePost">

          <?php
          if ($ListePosts) {
            foreach ($ListePosts as $ROW) {
              $user = new User();
              $ROW_USER = $user->get_data($ROW['userid']);
              include('post.php');



            }
          }

          ?>



        </div>

      </div>
    </div>
  </div>




</body>

</html>