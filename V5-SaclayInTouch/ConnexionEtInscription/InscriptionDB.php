<?php

class InscriptionDB {

    private $num = 0;
    private $error = "";

    public function evaluate($data) {

        // Vérification s'il y a des champs vides
        foreach($data as $key => $value){
            if(empty($value)){
                $this->error .= $key . " est vide <br>";
            }
        }

        // Si pas d'erreur il y'a création utilisateur
        if($this->error == ""){
            return $this->creer_utilisateur($data);
        } else {
            return $this->error;
        }
    }

    public function creer_utilisateur($data){

        // Incrémente le compteur interne
        $this->num++;

        $prenom = $data["prenom"];
        $nom = $data["nom"];
        $date_de_naissance = $data["dateDeNaissance"];
        $composante = $data["composante"];
        $email = $data["email"];
        $password = $data["password"];

        $url_adress = strtolower($prenom) . "." . strtolower($nom);

        // userid composante + numéro Polytech_1
        $userid = $composante . "_" . $this->num;

        $query = "INSERT INTO utilisateurs 
        (userid, prenom, nom, date_de_naissance, composante, email, password, url_adress)
        VALUES ('$userid', '$prenom', '$nom', '$date_de_naissance', '$composante', '$email', '$password', '$url_adress')";

        // Enregistrement dans la BD
        $BDInscriptions = new BD(); 
        $BDInscriptions->save($query);

        return $query;
    }
}

?>
