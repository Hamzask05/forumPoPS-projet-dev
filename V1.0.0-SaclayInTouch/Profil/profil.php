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
  $result = $post->create_post($id, $_POST, $_FILES);

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
  <link rel="stylesheet" href="Profil3.css">
  <link rel="stylesheet" href="contenu_profil_photo.css">
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
  <?php
  $section = "default";
  if (isset($_GET['section'])) {
    $section = $_GET['section'];
  }
  if ($section == "default") {
    include('contenu_profil.php');
  } else {
    include('contenu_profil_photo.php');
  }
  ?>




</body>

</html>