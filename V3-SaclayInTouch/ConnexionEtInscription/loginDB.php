<?php 

class LoginDB {

    private $error = "";

    public function evaluate($data){

        
        $email = addslashes($data["email"]); //adslashes par mesure de sécrurité
        $password = addslashes($data["password"]);

        
$query = "SELECT * FROM utilisateurs WHERE email='$email' LIMIT 1";

        // Enregistrement dans la BD
        $BDLogin = new BD(); 
        $result = $BDLogin->read($query);
        if($result){
            $row = $result[0]; // comme on a un seul resultat on return le premier élement
            if($password == $row["password"]){
                $_SESSION['userid']=$row['userid'];




        }else{$error = "email ou mot de passe faux";

        return $error;
    }}
}

   
}

?>