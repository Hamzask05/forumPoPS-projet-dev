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
  <link rel="stylesheet" href="Profil3.css">

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
       <?php 
          $image = "imagesParDefaut/imageDefaut.webp";
          if(file_exists($user_data['profil_image'])){
            $image = $user_data['profil_image'];
          }
          ?>
          <img src="<?php echo $image ?>" class="timeline-photo" alt="Photo de Profil">
        <h2 class="timeline-name"><a href="profil.php" id="timelinename">
          <?php
          echo $user_data["prenom"] . "<br> " . $user_data["nom"];
          ?>
        </a></h2>
      </div>
    </div>

    <div id="box">
      

      <div id="barrePost">
       
          
        
           <?php
           $DB = new BD() ;
           $user_class = new user();
           $ami = $user_class->get_friends($_SESSION["saclay_userid"]);
           $ami_id = false;
           if (is_array($ami)) {
            $ami_id = array_column($ami,"userid");
            $ami_id = "'" . implode("','", $ami_id) . "'";
           }
           if($ami_id){
            $sql = "SELECT * FROM posts WHERE userid IN ($ami_id) ORDER BY id DESC LIMIT 30";
            $posts = $DB->read($sql);
           }
           
          if ($posts) {
            foreach ($posts as $ROW) {
              $user = new User();
              $ROW_USER = $user->get_data($ROW['userid']);
              include('post1.php');



            }
          }

          ?>
         
        </div>
      </div>
    </div>
    
  </div>

</body>
</html>