<?php
//require_once ("app/includes/DBconnect.php");

class User extends connection
{
    public function create(){


    }
    public function getAllUsers(){
        $conn=connection::DBconnect();
        $sql = "SELECT * FROM users";
        $users = [];
        // fetch all posts as an associative array called $posts
        $result = $conn->query($sql) ;
        while($row = $result->fetch_assoc()){
            $users[]=$row;
        }
        return $users;
    }

    public function getUserById($id){
        $conn=connection::DBconnect();
        $sql="SELECT * FROM users WHERE id=
			(SELECT user_id FROM posts WHERE user_id=$id LIMIT 1)";

        // fetch all posts as an associative array called $posts
        if($conn->query($sql)){
            $result = $conn->query($sql)->fetch_assoc();
        }
        else{
            $result = null;
        }
        return $result;
    }

}