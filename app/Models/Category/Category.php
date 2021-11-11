<?php
//require_once ("app/includes/DBconnect.php");


class Category extends connection

{
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
    public function edit($id){
        global $conn, $name, $slug,$category_id;
        $sql = "SELECT * FROM categories WHERE id=$id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $category = mysqli_fetch_assoc($result);
        // set form values on the form to be updated
        $name = $category['name'];
        $slug = $category['slug'];
        $category_id = $category['id'];
    }
    public function update($request_values){
        global $conn, $name, $slug,$category_id,$errors;
//        print_r($request_values);die();
        $category_id = $request_values['id'];
        $name = esc($request_values['name']);
        $slug = esc($request_values['slug']);

// form validation: ensure that the form is correctly filled
        if (empty($name)) {
            array_push($errors, "Name is required");
        }
        if (empty($slug)) {
            array_push($errors, "Slug is required");
        }

//        print_r($post_id);die();
        if (count($errors) == 0) {
            $query = "UPDATE categories SET
                    name='$name',
                    slug='$slug',
                    created_at= now(),
                    updated_at= now()
                    WHERE id = $category_id";
//            print_r($query);die();
            $res = $conn->query($query);

            if ($res) {
                $_SESSION['message'] = "Category updated succesfully";
// redirect to admin area
                header('location: viewCategories.php');
                exit(0);
            } else {
                $_SESSION['message'] = "error in updating";
// redirect to public area
                header('location: editCategory.php');
                exit(0);
            }
        }

    }
    public function delete($id){
        global $conn;
        $posts=[];
        $query = "SELECT * FROM POSTS WHERE category_id=$id";
//        print_r($query);die();
        $res =$conn->query($query);
        while($row = $res->fetch_assoc()){
            $posts[]=$row;
        }
//        print_r($posts['category_id']);die();
        foreach ($posts as $post){
            $post['category_id'] = 1;
//            $post ->save();
//            print_r($post['category_id']);die();

        }

        $sql = "DELETE FROM categories WHERE id=$id";
        $result= $conn->query($sql);
        if ($result) {
            $_SESSION['message'] = "Category successfully deleted";
            header("location: viewCategories.php");
            exit(0);
        }
    }


}