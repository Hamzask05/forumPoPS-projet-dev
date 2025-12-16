<?php
session_start();


include("../ConnexionEtInscription/connexionDB.php");
include("../ConnexionEtInscription/loginDB.php");
include("user.php");
include("postDB.php");


$login = new LoginDB();
$user_data = $login->check_login($_SESSION["saclay_userid"]);


$post = new Post();
$ROW = false;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $ROW = $post->get_one_post($_GET['id']);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post = new Post();
    $userid = $_SESSION['saclay_userid'];
    $result = $post->create_post($userid, $_POST, $_FILES);

    if ($result == "") {

        header("Location: post_singulier.php?id=" . $_GET['id']);
        exit();


    } else {
        echo $result;


    }

}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Post | SaclayInTouch</title>
    <link rel="stylesheet" href="Profil3.css">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />

</head>

<body>

    <?php include("header.php"); ?>

    <div class="single-post-container">
        <?php
        $user = new User();
        if ($ROW) {


            $ROW_USER = $user->get_data($ROW['userid']);


            include("post1.php");

        } else {
            echo "Ce post n'existe pas ou a été supprimé.";
        }
        ?>
        <div id="posts">

            <form method="post" enctype="multipart/form-data">
                <textarea name="post" placeholder="Écrire un commentaire"></textarea>
                <div id="boutonPost">
                    <input type="hidden" name="parent" value="<?php echo $ROW['postid']?>">
                    <input id="postPhoto" type="file" name="file">
                    <input id="postBouton" type="submit" value="Publier">
                </div>
                <br>
        </div>
        </form>
        <br>
        <?php 
        $comment = $post->get_comments($ROW['postid']);
        if(is_array( $comment )) {
            foreach ($comment as $COMMENT) {
                
                $ROW_USER = $user->get_data($COMMENT['userid']);
                include('comment.php');
                
        }}
        ?>
    </div>

</body>

</html>