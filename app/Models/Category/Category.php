<?php
//require_once ("app/includes/DBconnect.php");


class Category extends connection

{
//    public $conn;
//    public function __construct()
//    {
//        $this->conn = connection::DBconnect();
//    }
    public function getAllCategories(){
        $conn=connection::DBconnect();
        $sql = "SELECT * FROM categories";
        $categories = [];
        // fetch all posts as an associative array called $posts
        $result = $conn->query($sql) ;
        while($row = $result->fetch_assoc()){
            $categories[]=$row;
        }
        return $categories;
    }

    public function getCategoryById($id){
        $conn=connection::DBconnect();
        $sql="SELECT * FROM categories WHERE id=
			(SELECT category_id FROM posts WHERE category_id=$id LIMIT 1)";
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