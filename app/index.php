<?php

use App\Models\Category\Category;
use App\Models\posts\Post;
use App\Models\users\User;

include ("includes/public_functions.php");
require_once ("includes/register_login.php");
include('../resources/navbar.php') ;
include('../resources/header.php') ;
require_once ("Models/Category/Category.php");
require_once ("Models/users/User.php");
//require 'vendor/autoload.php';
?>

<body style="font-family: Open Sans, sans-serif">
<?php $posts = (new Post)->all(); ?>

<div class="lg:grid lg:grid-cols-6">
    <?php if ($posts){
        foreach ($posts as $key => $post):
            $category_id=$post['category_id'];
            $user_id=$post['user_id'];
            $category = (new Category)->getCategoryById($category_id);
            $user = (new User)->getUserById($user_id);
            if ($key == 0) {?>
                <article class="col-span-6">
                    <?php include('../resources/specialPostCard.php'); ?>
                </article>
                <?php
            } elseif ($key == 1 or $key == 2) {
                ?>
                <article class="col-span-3">
                    <?php include('../resources/postCard.php'); ?>
                </article>
                <?php
            } else {
                ?>
                <article class="col-span-2">
                    <?php include('../resources/postCard.php'); ?>
                </article>
                <?php
            }
        endforeach;
    }?>



</div>
</body>
<?php include('../resources/footer.php') ?>

