
            <div class="Ami">
              <?php
              $image = "imagesParDefaut/imageDefaut.webp"; 
              if(file_exists($FRIEND_ROW['profil_image'])){
                  $image = $FRIEND_ROW['profil_image'];}
              
              ?>
             
              
              <img src="<?php echo $image ?>" id="photoAmi" alt="Phoo ami">
              <?php echo $FRIEND_ROW['prenom'] . " " .$FRIEND_ROW['nom'] ?>

            </div>