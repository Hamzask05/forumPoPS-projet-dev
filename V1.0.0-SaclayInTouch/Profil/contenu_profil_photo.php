<?php


echo '<link rel="stylesheet" href="profilphoto.css">';
?>

<?php
$BD = new BD();

$sql = "SELECT image, postid FROM posts WHERE has_image = 1 AND userid = '$user_data[userid]' ORDER BY id DESC LIMIT 30";
$images = $BD->read($sql);

if (is_array($images)) {
    echo "<div class='gallery-container'>";
    
    foreach ($images as $row) {
        $img_src = $row['image'];

        
        if (file_exists($img_src)) {
            echo "
            <div class='gallery-item' 
                 data-bs-toggle='modal' 
                 data-bs-target='#photoModal' 
                 onclick=\"afficherImage('$img_src')\">
                 
                <img src='$img_src' class='gallery-img' alt='Photo utilisateur'>
            </div>";
        }
    }
    echo "</div>";

} else {
    echo ">Aucune photo publiée pour le moment.";
}
?>

<div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 position-relative text-center">
        
        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" 
                data-bs-dismiss="modal" aria-label="Close" 
                ></button>
        
        <img src="" id="imageDansLeModal" class="img-fluid rounded shadow" style="max-height: 85vh; object-fit: contain;">
      
      </div>
    </div>
  </div>
</div>

<script src="profilphoto.js"></script>