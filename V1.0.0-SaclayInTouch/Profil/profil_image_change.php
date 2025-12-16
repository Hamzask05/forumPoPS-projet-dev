<?php

session_start();

include("../ConnexionEtInscription/connexionDB.php");
include("../ConnexionEtInscription/loginDB.php");
include("user.php");



$login = new LoginDB();
$user_data = $login->check_login($_SESSION["saclay_userid"]);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
        $allowed_size = 1024 * 1024 * 3;

        if ($_FILES["file"]["type"] == "image/jpeg") {
            if ($_FILES["file"]["size"] <= $allowed_size) {
                $filename = "Uploads/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $filename);
                if (file_exists($filename)) {
                    $userid = $user_data['userid'];
                    $query = "UPDATE utilisateurs set profil_image = '$filename' where userid= '$userid' limit 1 ";
                    $BD = new BD();
                    $BD->save($query);
                    header("Location: profil.php");
                    die();

                }

            } else {
                echo "Le fichier envoyer n'est pas une image ";
                echo "<br> Veuillez envoyer un fichier de taille 3MB ou inferieur ";
            }
        } else {
            echo "Le fichier envoyer n'est pas une image ";
            echo "<br> Veuillez envoyer un fichier de type jpeg";
        }


    } else {
        echo "Le fichier envoyer n'est pas une image ";
        echo "<br> Veuillez envoyer un fichier valide";
    }
}
?>

<!doctype html>
<html lang="fr" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <title>Changer de Photo de profil</title>
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
    <form method="post" enctype="multipart/form-data">
        <div id="contenant" class="timeline-container">

            <div id="TimelineProfil">
                <div class="profil-summary">
                    <input type="file" name="file">
                    <input id="post_button" type="submit" value="Valider">
                </div>
            </div>


            <!-- Affichage de la photo de profil !-->
             <div id="ImageCharg">
                <img src="<?php echo $user_data['profil_image']  ?>">


             </div>



        </div>
    </form>
</body>

</html>