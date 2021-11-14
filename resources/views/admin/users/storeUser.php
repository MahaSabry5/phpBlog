<?php
require_once '../includes/DBconnect.php';
require_once("../Models/users/User.php");

$conn = (new connection)->DBconnect();
$name = "";
$username = "";
$email = "";
$user_id = "";
$errors = array();

if (isset($_GET['edit_id'])) {
    (new User)->edit($_GET['edit_id']);
}
if (isset($_POST['edit'])) {
    (new User)->update($_POST);
}
if (isset($_GET['delete-user'])) {
    (new User)->delete($_GET['delete-user']);
}

function esc(String $value)
{
    global $conn;
    $val = trim($value); // remove empty space sorrounding string
    $val = mysqli_real_escape_string($conn, $value);
    return $val;
}
