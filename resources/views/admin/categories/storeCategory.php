<?php

require_once __DIR__.'/../../../../app/includes/DBconnect.php';
require_once __DIR__.'/../../../../app/Models/Category/Category.php';

$conn = (new connection)->DBconnect();
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
    global $conn;
    $val = trim($value); // remove empty space sorrounding string
    $val = mysqli_real_escape_string($conn, $value);
    return $val;
}
