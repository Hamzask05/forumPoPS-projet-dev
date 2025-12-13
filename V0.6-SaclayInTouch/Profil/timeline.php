<?php

  session_start();

  include("../ConnexionEtInscription/connexionDB.php");
  include("../ConnexionEtInscription/loginDB.php");
  include("user.php");



  $login = new LoginDB();
  $user_data=$login->check_login($_SESSION["saclay_userid"]);
?>

<!doctype html>
<html lang="fr" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <title>Timeline - SaclayInTouch</title>
  <link rel="stylesheet" href="Profil1.css">

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="../assets/js/color-modes.js"></script>
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php 
  include("header.php");
  ?>

  <div id="contenant" class="timeline-container">

    <div id="TimelineProfil">
      <div class="profil-summary">
        <img src="photoDeProfil.jpeg" class="timeline-photo" alt="Photo de Profil">
        <h2 class="timeline-name"><a href="profil.php" id="timelinename">
          <?php
          echo $user_data["prenom"] . "<br> " . $user_data["nom"];
          ?>
        </a></h2>
      </div>
    </div>

    <div id="box">
      <div id="posts">
        <textarea placeholder="Quoi de neuf ?"></textarea>
        <input id="postBouton" type="submit" value="Publier">
      </div>

      <div id="barrePost">
        <div class="post">
          <img src="PhotoAmis/PhotoMehdi.jpeg" class="photoAmiPost" alt="Photo Ami">
          <div>
            <div class="nomUtilisateur">Mehdi Serraj</div>
            Ceci est un exemple de post sur la timeline.
            <br /> <br />
            <a href="#">J'aime</a> . <a href="#">Commentaire</a> . <span class="date">Aujourd'hui</span>
          </div>
        </div>
      </div>
    </div>
    
  </div>

</body>
</html>