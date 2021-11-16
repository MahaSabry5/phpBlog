<?php

use App\Models\posts\Post;

require_once '../includes/DBconnect.php';
$conn = new connection();
$conn=$conn->DBconnect();
$comment ="";
$title = "";
$slug = "";
$excerpt = "";
$body = "";
$category_id = "";
$errors = array();
//register new user

if (isset($_POST['publish'])) {
    (new Post)->create($_POST);
}
if (isset($_GET['edit_id'])) {
    (new Post)->edit($_GET['edit_id']);
}
if (isset($_POST['edit'])) {
    (new Post)->update($_POST);
}
if (isset($_GET['delete-post'])) {
    (new Post)->delete($_GET['delete-post']);
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
