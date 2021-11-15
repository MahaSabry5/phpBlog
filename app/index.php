<?php

//$home_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//echo $home_url;

use App\Models\Category\Category;
use App\Models\posts\Post;
use App\Models\users\User;

$logo_url = '../public/images/logo.svg';
$specialCard = '../public/images/illustration-1.png';
$postCard='../public/images/illustration-5.png';
$laryAvatar ='../public/images/lary-avatar.svg';
$laryLetter='../public/images/lary-newsletter-icon.svg';
$mailBoxIcon='../public/images/mailbox-icon.svg';


require_once __DIR__ . "/../app/includes/register_login.php";
include __DIR__ . '/../resources/views/components/navbar.php';
require_once __DIR__ . '/../resources/views/components/header.php';
require_once __DIR__ . '/../app/Models/posts/Post.php';
require_once __DIR__ . '/../app/Models/users/User.php';
require_once __DIR__ . '/../app/Models/Category/Category.php';

?>

<body style="font-family: Open Sans, sans-serif">
<?php $posts = (new Post)->all();
?>
<div class="lg:grid lg:grid-cols-6">
    <?php if ($posts){
        foreach ($posts as $key => $post):
            $category_id=$post['category_id'];
            $user_id=$post['user_id'];
            $category = (new Category)->getCategoryById($category_id);
            $user = (new User)->getUserById($user_id);
            if ($key == 0) {?>
                <article class="col-span-6">
                    <?php include __DIR__ .'/../resources/views/components/specialPostCard.php'; ?>
                </article>
                <?php
            } elseif ($key == 1 or $key == 2) {
                ?>
                <article class="col-span-3">
                    <?php include __DIR__ .'/../resources/views/components/postCard.php'; ?>
                </article>
                <?php
            } else {
                ?>
                <article class="col-span-2">
                    <?php include __DIR__ .'/../resources/views/components/postCard.php';?>
                </article>
                <?php
            }
        endforeach;
    }?>
</div>
</body>
<?php include_once __DIR__ .'/../resources/views/components/footer.php'; ?>

