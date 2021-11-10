<?php


class Post extends connection
{
    public function getAllPosts(){
        $conn=connection::DBconnect();
        $sql = "SELECT * FROM posts";
        $posts = [];
        // fetch all posts as an associative array called $posts
        $result = $conn->query($sql) ;
        while($row = $result->fetch_assoc()){
            $posts[]=$row;
        }
        return $posts;
    }
    public function getPost($id){
        $conn=connection::DBconnect();
        $sql = "SELECT * FROM posts
                WHERE id = $id ";
        $posts = [];
        // fetch all posts as an associative array called $posts
        $result = $conn->query($sql)->fetch_assoc() ;
//        while($row = $result->fetch_assoc()){
//            $posts[]=$row;
//        }
        return $result;
    }
    public function getCatPosts($id){
        $conn=connection::DBconnect();
        $sql="SELECT * FROM posts WHERE category_id=
			(SELECT id FROM categories WHERE id=$id)";
        $posts = [];
        // fetch all posts as an associative array called $posts
        $result = $conn->query($sql) ;
        while($row = $result->fetch_assoc()){
            $posts[]=$row;
        }
        return $posts;
    }
    public function getuserPosts($id){
        $conn=connection::DBconnect();
        $sql="SELECT * FROM posts WHERE user_id=
			(SELECT id FROM users WHERE id=$id)";
        $posts = [];
        // fetch all posts as an associative array called $posts
        $result = $conn->query($sql) ;
        while($row = $result->fetch_assoc()){
            $posts[]=$row;
        }
        return $posts;
    }


}