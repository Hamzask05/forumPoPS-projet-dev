
<?php

$BD = new BD();
$sql = "SELECT image,postid from posts where has_image = 1 && userid = '$user_data[userid]' order by id desc limit 30";
$images = $BD->read($sql);

if (is_array($images)) {
    echo "<div class='gallery-container'>";
    foreach ($images as $image) {
        echo "
        <div class='gallery-item'>
        <img src= '$image[image]' class='gallery-img' alt='Photo utilisateur' >
        </div>";
    }
    echo "</div>";
} else {
    echo "<div style='padding:20px; text-align:center; color:gray;'>Aucune photo publiée pour le moment.</div>";
}
?>