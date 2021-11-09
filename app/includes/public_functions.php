
<?php
require_once __DIR__ . "/../includes/DBconnect.php";
require_once __DIR__ . "/../Models/posts/Post.php";

    function getPublishedPosts() {
        $conn = new connection();
        $conn = $conn->DBconnect();
        Post::getAllPosts($conn);
    }
?>