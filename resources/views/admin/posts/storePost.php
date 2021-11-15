<?php
require_once __DIR__. '/../../../../app/includes/DBconnect.php';
$conn = (new connection)->DBconnect();
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
    global $conn;
    $val = trim($value); // remove empty space sorrounding string
    $val = mysqli_real_escape_string($conn, $value);
    return $val;
}

