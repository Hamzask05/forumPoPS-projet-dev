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

    public function get_user($id){
           $query = "select * from utilisateurs where id = '$id' limit 1 ";
           $dataB = new BD();
           $result = $dataB->read($query);
           if($result){
            return $result[0];
           }else {
            return false;
           }
    }
    public function get_friends($id)
   {
      $query = "SELECT * FROM utilisateurs WHERE userid != '$id' ";
      $DB = new BD();
      $result = $DB->read($query);
      if ($result) {
         return $result;
      } else
         return false;
   }

}

?>