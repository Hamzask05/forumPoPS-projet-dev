<?php
session_start();
if(isset($_SESSION['saclay_userid'])) {
    $_SESSION['saclay_userid'] = NULL;
     unset($_SESSION['saclay_userid']);
}

header("Location: connexion.php");
die(); 

