<?php
require_once '../includes/DBconnect.php';
require_once("../Models/Category/Category.php");

$conn = new connection();
$conn=$conn->DBconnect();
$name = "";
$slug = "";
$category_id = "";
$errors = array();

if (isset($_GET['edit_id'])) {
    (new Category)->edit($_GET['edit_id']);
}
if (isset($_POST['edit'])) {
    (new Category)->update($_POST);
}
if (isset($_GET['delete-category'])) {
    (new Category)->delete($_GET['delete-category']);
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
