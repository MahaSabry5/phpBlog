<?php
namespace App\Models\Category;

use App\Models\Model;
require_once __DIR__ . '/../Model.php';

class Category extends Model

{
    public function all(){
        $conn = $this->connection;
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
        $conn = $this->connection;
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
        global  $name, $slug,$category_id;
        $conn = $this->connection;
        $sql = "SELECT * FROM categories WHERE id=$id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $category = mysqli_fetch_assoc($result);
        // set form values on the form to be updated
        $name = $category['name'];
        $slug = $category['slug'];
        $category_id = $category['id'];
    }
    public function update($request_values){
        global $name, $slug,$category_id,$errors;
        $conn = $this->connection;
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
        if (count($errors) == 0) {
            $query = "UPDATE categories SET
                    name='$name',
                    slug='$slug',
                    created_at= now(),
                    updated_at= now()
                    WHERE id = $category_id";
            $res = $conn->query($query);

            if ($res) {
                $_SESSION['message'] = "Category updated succesfully";
// redirect to admin area
                header('location:/../resources/views/admin/categories/viewCategories.php');
                exit(0);
            } else {
                $_SESSION['message'] = "error in updating";
// redirect to public area
                header('location: /../resources/views/admin/categories/editCategories.php');
                exit(0);
            }
        }

    }
    public function delete($id){
        $conn = $this->connection;
        $query = "UPDATE posts SET
                    category_id = 1
                    WHERE category_id = $id";
        $conn->query($query);

        $sql = "DELETE FROM categories WHERE id=$id";
        $result= $conn->query($sql);
        if ($result) {
            $_SESSION['message'] = "Category successfully deleted";
            header("location: /../resources/views/admin/categories/viewCategories.php");
            exit(0);
        }
    }


}