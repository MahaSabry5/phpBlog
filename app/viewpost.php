<?php
include("includes/public_functions.php");
include('../resources/navbar.php');
include('../resources/header.php');
require_once("Models/posts/Post.php");
require_once("Models/Category/Category.php");
require_once("Models/Comment/Comment.php");
require_once("Models/users/User.php");
//require 'vendor/autoload.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $post = (new Post)->getPost($id);
    $comments = (new Comment)->all($id);
}
?>
<body style="font-family: Open Sans, sans-serif">

<div class="lg:grid lg:grid-cols-6">
    <!--    --><?php //foreach ($posts as $key => $post):
    $category_id = $post['category_id'];
    $user_id = $post['user_id'];
    $category = (new Category)->getCategoryById($category_id);
    $user = (new User)->getUserById($user_id);

    ?>
    <article class="col-span-6">
        <?php include('../resources/specialPostCard.php'); ?>

    </article>
    <section class="col-span-8 col-start-4 mr-10 mt-10 space-y-6">

        <?php
        if ($_SESSION) {
            if ($_SESSION['user']['role'] == 'user') {
                include 'commentForm.php';
            }
            if ($comments) {
                foreach ($comments as $comment) {
                    $author_id=$comment['user_id'];
                    $author=(new User)->getUserById($author_id);
                    include 'commentLayout.php';
                }
            }
        }
        else{
            if ($comments) {
                foreach ($comments as $comment) {
                    $author=(new User)->getUserById($comment['user_id']);
//                    print_r($author);
                    include 'commentLayout.php';
                }
            }
        }


        ?>
    </section>

    <!--    --><?php //endforeach ?>
</div>
</body>
<?php include('../resources/footer.php') ?>
