<?php

class LoginDB
{

    private $error = "";

    public function evaluate($data)
    {


        $email = addslashes($data["email"]); //adslashes par mesure de sécrurité
        $password = addslashes($data["password"]);


        $query = "SELECT * FROM utilisateurs WHERE email='$email' LIMIT 1";

        // Enregistrement dans la BD
        $BDLogin = new BD();
        $result = $BDLogin->read($query);
        if ($result) {
            $row = $result[0]; // comme on a un seul resultat on return le premier élement
            if ($password == $row["password"]) {
                $_SESSION['saclay_userid'] = $row['userid'];
                return "";
            } else {
                return "Mot de passe incorrect";
            }




        } else {
            $error = "Utilisateur inexistant";

            return $error;
        }
    }



    public function check_login($id)
    {
        $id = addslashes($id);
            $query = "SELECT * FROM utilisateurs WHERE userid='$id' LIMIT 1";
            $BDLog = new BD();
            $result = $BDLog->read($query);
            if ($result) {
                $user_data = $result[0];
                return $user_data;

            } else {
                header(header: "Location: ../ConnexionEtinscription/connexion.php");
                die;
            }
        





    }

}




?>