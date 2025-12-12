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
if(!isset($_SESSION["saclay_userid"])){
    header("Location: ../ConnexionEtInscription/connexion.php");
    die(); // Très important : cela arrête la lecture du reste du code
}

// 3. RÉCUPÉRATION DES DONNÉES (Puisque l'utilisateur est connecté)
$id = $_SESSION["saclay_userid"];
$login = new LoginDB();
$result = $login->check_login($id);

if($result){
    $user = new User();
    $user_data = $user->get_data($id);
    
    // Si l'utilisateur n'est pas trouvé dans la BDD (cas rare mais possible)
    if(!$user_data){
        header("Location: ../ConnexionEtInscription/connexion.php");
        die();
    }
} else {
    // Si le check_login échoue
    header("Location: ../ConnexionEtInscription/connexion.php");
    die();
}

// Traitement de la création de posts.

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $post = new Post();
  $result = $post->create_post($id, $_POST);
  
  if($result==""){

  header("Location: profil.php");
  exit();


  }else{
        echo $result;


  }

}
// récupération des posts 

  $mesPosts = new Post();
  $ListePosts = $mesPosts->get_posts($id);





?>




<!doctype html>
<html lang="fr" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <title>Profil</title>
  <link rel="stylesheet" href="Profil.css">

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
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">SaclayInTouch</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03"
        aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav me-auto mb-2 mb-sm-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Profile</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="timeline.html">Timeline</a></li>
          <li class="nav-item">
            <a href="../ConnexionEtInscription/deconnexion.php" class="nav-link" aria-disabled="true">Déconnexion</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </li>
        </ul>

      </div>
    </div>
  </nav>
  <!--Fin du code de la nav-->

  <!--Couverture et Profil-->
  <div id="Couverture">
    <div id="CouvertureContenu">
      <img src="../Images/PolytechParisSaclay.jpeg" id="imagePolytech" alt="Photo de couverture Polytech Paris-Saclay">
      <img src="photoDeProfil.jpeg" id="photoDeProfil" alt="Photo de Profil">
      <br>
      <?php echo $user_data['prenom']." ".$user_data['nom']?>  
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
        if($ListePosts){
          foreach($ListePosts as $ROW){
            $user = new User();
            $ROW_USER = $user->get_data($ROW['userid']);
            include('post.php'); 



        }}

        ?>
          


        </div>

      </div>
    </div>
  </div>




</body>

</html>