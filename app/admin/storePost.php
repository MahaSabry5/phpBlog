<?php
require_once '../includes/DBconnect.php';
$conn = new connection();
$conn=$conn->DBconnect();
$title = "";
$slug = "";
$excerpt = "";
$body = "";
$category_id = "";
$errors = array();
//register new user
if (isset($_POST['publish'])) {

    // receive all input values from the form
    $title = esc($_POST['title']);
    $slug = esc($_POST['slug']);
    $excerpt = esc($_POST['excerpt']);
    $body = esc($_POST['body']);
    $category_id = esc($_POST['category_id']);


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
        $query = "INSERT INTO posts (category_id,slug,title,body, excerpt,created_at, updated_at) 
					  VALUES('$category_id','$slug', '$title', '$body','$excerpt', now(), now())";
        $conn->query($query) ;

        // get id of created user
        $reg_post_id = $conn->insert_id;

        // put logged in user into session array
        $_SESSION['post'] = getPostById($reg_post_id);
//        print_r($_SESSION);die();
        if ($_SESSION['post']) {
            $_SESSION['message'] = "Post created succesfully";
            // redirect to admin area
            header('location: dashboard.php');
            exit(0);
        } else {
            $_SESSION['message'] = "You are now logged in";
            // redirect to public area
            header('location: createPost.php');
            exit(0);
        }
    }
}
if (isset($_POST['edit'])) {
    // receive all input values from the form
//    print_r($title,$slug);die();
    $post_id =$_GET['id'];
    $title = esc($_POST['title']);
    $slug = esc($_POST['slug']);
    $excerpt = esc($_POST['excerpt']);
    $body = esc($_POST['body']);
    $category_id = esc($_POST['category_id']);


// form validation: ensure that the form is correctly filled
    if (empty($title)) {  array_push($errors, "Title is required"); }
    if (empty($slug)) {  array_push($errors, "Slug is required"); }
    if (empty($excerpt)) { array_push($errors, "Excerpt is required"); }
    if (empty($body)) { array_push($errors, "Body is required"); }
    if (empty($category_id)) { array_push($errors, "Category is required"); }

//    $check_query = "SELECT * FROM posts WHERE slug='$slug' LIMIT 1";
//    $result = $conn->query($check_query) ;
//
//    $postres = $result->fetch_assoc();
//    print_r($postres);die();
//
//    if ($postres) { // if slug exists
//        if ($postres['slug'] === $slug) {
//            array_push($errors, "This slug is taken");
//        }
//    }
    if (count($errors) == 0) {
        $query = "UPDATE posts SET 
                 category_id =$category_id,
                 slug=$slug,
                 title=$title,
                 body=$body,
                 excerpt=$excerpt,
                 created_at= now(),
                 updated_at= now()
				 WHERE id = $post_id";


//print_r($query);die();
        // get id of created user

        // put logged in user into session array
//        print_r($_SESSION);die();
        if ( $conn->query($query)) {
            $_SESSION['message'] = "Post updated succesfully";
            // redirect to admin area
            header('location: dashboard.php');
            exit(0);
        } else {
            $_SESSION['message'] = "error in updating";
            // redirect to public area
            header('location: editPost.php');
            exit(0);
        }
    }
}

function esc(String $value)
{
    // bring the global db connect object into function
    global $conn;

    $val = trim($value); // remove empty space sorrounding string
    $val = mysqli_real_escape_string($conn, $value);

    return $val;
}
function getPostById($id)
{
    global $conn;
    $sql = "SELECT * FROM posts WHERE id=$id LIMIT 1";
    $result = $conn->query($sql) ;
    $post = $result->fetch_assoc();
    return $post;
}
