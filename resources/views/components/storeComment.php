<?php
require_once __DIR__ .'/../../../app/includes/DBconnect.php';
require_once __DIR__ .'/../../../app/Models/Comment/Comment.php';

$conn = new connection();
$conn=$conn->DBconnect();
$body = "";
$errors = array();

if (isset($_GET['id'])) {
    (new Comment)->store($_POST);
}
if (isset($_GET['delete-comment'])) {
    (new Comment)->delete($_GET['delete-comment']);
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
