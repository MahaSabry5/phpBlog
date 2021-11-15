<?php


class Post
{
    public function all(){
        global $conn;
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
        global $conn;
//        print_r($conn);die();
        $sql = "SELECT * FROM posts
                WHERE id = $id ";
        // fetch all posts as an associative array called $posts
        $post = $conn->query($sql)->fetch_assoc() ;
        return $post;
    }
    public function getCatPosts($id){
        global $conn;
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
        global $conn;
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
    public function create($request_values){
        global $conn, $title, $slug, $body,$excerpt,$category_id,$errors;
        // receive all input values from the form
        $user_id=$_SESSION['user']['id'];
        $title = esc($request_values['title']);
        $slug = esc($request_values['slug']);
        $excerpt = esc($request_values['excerpt']);
        $body = esc($request_values['body']);
        $category_id = esc($request_values['category_id']);


// form validation: ensure that the form is correctly filled
        if (empty($title)) {  array_push($errors, "Title is required"); }
        if (empty($slug)) {  array_push($errors, "Slug is required"); }
        if (empty($excerpt)) { array_push($errors, "Excerpt is required"); }
        if (empty($body)) { array_push($errors, "Body is required"); }
        if (empty($category_id)) { array_push($errors, "Category is required"); }

        $check_query = "SELECT * FROM posts WHERE slug='$slug' LIMIT 1";
        $result = $conn->query($check_query) ;

        $post = $result->fetch_assoc();

        if ($post) { // if user exists
            if ($post['slug'] === $slug) {
                array_push($errors, "This slug is taken");
            }
        }
        if (count($errors) == 0) {
            $query = "INSERT INTO posts (user_id,category_id,slug,title,body, excerpt,created_at, updated_at) 
					  VALUES($user_id,$category_id,'$slug', '$title', '$body','$excerpt', now(), now())";
            $conn->query($query) ;
            // get id of created post
            $reg_post_id = $conn->insert_id;
            $_SESSION['post'] = $this->getPost($reg_post_id);
//        print_r($_SESSION);die();
            if ($_SESSION['post']) {
                $_SESSION['message'] = "Post created succesfully";
                // redirect to admin area
                header('location: /../../../../resources/views/admin/dashboard.php');
                exit(0);
            } else {
                $_SESSION['message'] = "You are now logged in";
                // redirect to public area
                header('location: /../../../../resources/views/admin/posts/createPost.php');
                exit(0);
            }
        }
    }
    public function edit($id){
        global $conn, $title, $slug, $body,$excerpt,$category_id, $post_id;
        $sql = "SELECT * FROM posts WHERE id=$id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $post = mysqli_fetch_assoc($result);
        // set form values on the form to be updated
        $post_id = $post['id'];
        $title = $post['title'];
        $excerpt =$post['excerpt'];
        $slug = $post['slug'];
        $body = $post['body'];
        $category_id = $post['category_id'];

    }
    public function update($request_values){
        global $conn, $title, $slug, $body,$excerpt,$category_id, $post_id,$errors;
        $post_id = $request_values['id'];
        $title = esc($request_values['title']);
        $slug = esc($request_values['slug']);
        $excerpt = esc($request_values['excerpt']);
        $body = esc($request_values['body']);
        $category_id = esc($request_values['category_id']);


// form validation: ensure that the form is correctly filled
        if (empty($title)) {
            array_push($errors, "Title is required");
        }
        if (empty($slug)) {
            array_push($errors, "Slug is required");
        }
        if (empty($excerpt)) {
            array_push($errors, "Excerpt is required");
        }
        if (empty($body)) {
            array_push($errors, "Body is required");
        }
        if (empty($category_id)) {
            array_push($errors, "Category is required");
        }

        if (count($errors) == 0) {
            $query = "UPDATE posts SET
                    category_id =$category_id,
                    slug='$slug',
                    title='$title',
                    excerpt='$excerpt',
                    body='$body',
                    created_at= now(),
                    updated_at= now()
                    WHERE id = $post_id";
            $res = $conn->query($query);

            if ($res) {
                $_SESSION['message'] = "Post updated succesfully";
// redirect to admin area
                header('location:  /../../../../resources/views/admin/dashboard.php');
                exit(0);
            } else {
                $_SESSION['message'] = "error in updating";
// redirect to public area
                header('location:  /../../../../resources/views/admin/posts/editPost.php');
                exit(0);
            }
        }

    }
    public function delete($id){
        global $conn;
        $sql = "DELETE FROM posts WHERE id=$id";
        $result= $conn->query($sql);
        if ($result) {
            $_SESSION['message'] = "Post successfully deleted";
            header("location: /../../../../resources/views/admin/dashboard.php");
            exit(0);
        }
    }


}