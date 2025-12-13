     <div class="post">
            <div class="post-image">
              <?php $image = "imagesParDefaut/imageDefaut.webp" ?>
              <img src="<?php echo $image ?>" class="photoAmiPost" alt="Photo Ami">
            </div>
            <div class="postContent">
              <div class="nomUtilisateur"><?php echo $ROW_USER['prenom']." ".$ROW_USER['nom'] ?></div>
              <?php echo $ROW['post']  ?> 
              <br>
              <br>
              
              <?php 
              if (file_exists($ROW['image'])){
                
                $post_image = $ROW['image'];
                echo "<img src='$post_image' class='postImageContent' alt='Photo Postee'> ";

              }
              
               ?>
              <br/> <br/>

              <a href="#">J'aime</a> . <a href="#">
                Commentaire</a> . <span class="date"><?php echo $ROW['date']
               ?> </span>
            </div>
          </div>