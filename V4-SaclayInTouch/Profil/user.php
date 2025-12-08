<?php 

class User{

    public function get_data($id){
    
        $query = "SELECT * FROM utilisateurs WHERE userid='$id' LIMIT 1";
    
     $dataB = new BD();
     $result = $dataB->read($query);
     if($result){
        $row = $result[0];

        return $row;

     }else{
        return false;

     }

    }

}

?>