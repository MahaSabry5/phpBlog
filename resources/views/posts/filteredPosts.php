<?php

use App\Models\Category\Category;
use App\Models\posts\Post;
use App\Models\users\User;

$logo_url = '../../../public/images/logo.svg';
$specialCard = '../../../public/images/illustration-1.png';
$postCard='../../../public/images/illustration-5.png';
$laryAvatar ='../../../public/images/lary-avatar.svg';
$laryLetter='../../../public/images/lary-newsletter-icon.svg';
$mailBoxIcon='../../../public/images/mailbox-icon.svg';

//require_once __DIR__ .'/../../../app/includes/DBconnect.php';
require_once __DIR__ .'/../../../app/Models/Category/Category.php';
require_once __DIR__ .'/../../../app/Models/posts/Post.php';
require_once __DIR__ .'/../../../app/Models/users/User.php';
include_once __DIR__ .'/../components/navbar.php';
include_once __DIR__ .'/../components/header.php';


if (isset($_GET['category'])) {
    $cat_id = $_GET['category'];
    $posts = (new Post)->getCatPosts($cat_id);
} elseif (isset($_GET['user'])) {
    $author_id = $_GET['user'];
    $posts = (new Post)->getuserPosts($author_id);

} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $posts = (new Post)->getPost($id);
}
?>

<body style="font-family: Open Sans, sans-serif">

<div class="lg:grid lg:grid-cols-6">
    <?php if ($posts){
        foreach ($posts as $key => $post):
            $category_id = $post['category_id'];
            $user_id = $post['user_id'];
            $category = (new Category)->getCategoryById($category_id);
            $user = (new User)->getUserById($user_id);

            ?>
            <article class="col-span-6">
                <?php include_once __DIR__ .'/../components/specialPostCard.php';
                ?>
            </article>

        <?php endforeach;
    } ?>


</div>
</body>
<?php include_once __DIR__ .'/../components/footer.php'?>

