 <div id="Couverture">
    <div id="CouvertureContenu">
      <?php
      
      // cover arbitraire selon la composante 
      $compo = $user_data['composante'];
      if ($compo == 'PLY') { $cover = '../Images/PolytechParisSaclay.jpeg';

      }else if ($compo == 'CS') {
        $cover = '../Images/CS.webp';

      }else{ $cover = "../Images/CampusParisSaclay.jpg";

      }
      
      
      ?>
      <img src="<?php echo $cover  ?>" id="imagePolytech" alt="Photo de couverture Polytech Paris-Saclay">
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

    <div id="contenant" >

      <!--Liste des Amis-->

      <div id="EspacesAmis">
        <div id="listeAmis">
          Amis<br>
          <div id="nomsEtPhotos">
             <?php
          if ($friends) {
            foreach ($friends as $FRIEND_ROW) {
              include("users.php");
            }
          }
          ?>

          </div>
        </div>

      </div>

      <!--Post Perso Creation-->
      <div id="box">
        <div id="posts">

          <form method="post" enctype="multipart/form-data">
            <textarea name="post" placeholder="Quoi de neuf ?"></textarea>
            <div id="boutonPost">
            <input id="postPhoto" type="file" name="file">
            <input id="postBouton" type="submit" value="Publier">
            </div>
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