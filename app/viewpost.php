<?php
include("includes/public_functions.php");
include('../resources/navbar.php');
include('../resources/header.php');
require_once("Models/Category/Category.php");
require_once("Models/users/User.php");
//require 'vendor/autoload.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $posts = (new Post)->getPost($id);
}
?>
<body style="font-family: Open Sans, sans-serif">

<div class="lg:grid lg:grid-cols-6">
    <?php foreach ($posts as $key => $post):
        $category_id = $post['category_id'];
        $user_id = $post['user_id'];
        $category = (new Category)->getCategoryById($category_id);
        $user = (new User)->getUserById($user_id);

        ?>
        <article class="col-span-6">
            <?php include('../resources/specialPostCard.php'); ?>
        </article>

    <?php endforeach ?>
</div>
</body>
<?php include('../resources/footer.php') ?>
