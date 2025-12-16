<div class="post">
  <div class="post-image">
    <?php

    $image = "imagesParDefaut/imageDefaut.webp";
    if (file_exists($ROW_USER['profil_image'])) {
      $image = $ROW_USER['profil_image'];
    }

    ?>
    <img src="<?php echo $image ?>" class="photoAmiPost" alt="Photo Ami">
  </div>
  <div class="postContent">
    <div class="nomUtilisateur"><?php echo $ROW_USER['prenom'] . " " . $ROW_USER['nom'] ?></div>
    <?php echo $ROW['post'] ?>
    <br>

    <?php
    // On vérifie si 'image' n'est pas vide et si le fichier existe vraiment
    if (!empty($ROW['image']) && file_exists($ROW['image'])) {
      $post_image = $ROW['image'];
      echo "<img src='$post_image' class='postImageContent' alt='Image du post'>";
    }
    ?>


    <a href="post_singulier.php?id=<?php echo $ROW['postid'] ?>">

      Commentaire</a> . <span class="date"><?php echo $ROW['date']
        ?> </span>
  </div>
</div>