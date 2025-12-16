<?php

class BD {

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "saclayInTouch_db";

    function connection_bd() {
        $connexion = mysqli_connect($this->host, $this->username, $this->password, $this->db);

        if (!$connexion) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }

        return $connexion;
    }

    function save($query) {
        $conn = $this->connection_bd();

        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Erreur SQL : " . mysqli_error($conn));
        }

        return $result;
    }

    function read($query){
        $conn = $this->connection_bd();
        $result = mysqli_query($conn, $query);
        if (!$result){
            return false;
        }else{
            $data=[];
            while($row = mysqli_fetch_array($result)){
                $data[]=$row;
            }
            return $data;
        }
    }
}

// Exemple d'utilisation
$BaseDeDonnéesSaclay = new BD();
?>
