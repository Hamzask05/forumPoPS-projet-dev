<?php 
class Post {
    private $error ="";

    function create_post($userid, $data, $files){
        if(!empty($data['post']) || !empty($files['file']['name'])){

            $my_image="";
            $has_image=0;

            if(!empty($files['file']['name'])){
                $has_image= 1;
                $filename = "Uploads/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $filename);

            }

            $post = addslashes(string: $data['post']);
            $postid = $this->create_postid();
            $query = "INSERT INTO posts (postid, userid, post, image, comments, likes, has_image) 
          VALUES ('$postid', '$userid', '$post', '$my_image', 0, 0, $has_image)";
            $DB = new BD();
            $DB->save($query);



    }else {
        $this->error = "Veuillez écrire un texte valide";
    }
    return $this->error;
}
private function create_postid(){
    $lenght = rand(4,19);
    $number ="";
    for($i = 0; $i < $lenght; $i++){
        $new_rand =rand(0,9);
        $number .= $new_rand;
    }
    return $number;

}

public function get_posts($userid){

$query = "select * from posts where userid = '$userid' order by id desc limit 10"; // car id est en auto increment
        $DB = new BD();
        $result = $DB->read($query);
        if($result){
            return $result;
        } else{
            return false;
        }

}


}


?>