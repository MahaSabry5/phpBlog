<?php

use App\Models\Category\Category;
use App\Models\Comment\Comment;
use App\Models\users\User;
$logo_url = '../../../public/images/logo.svg';
$specialCard = '../../../public/images/illustration-1.png';
$postCard='../../../public/images/illustration-5.png';
$laryAvatar ='../../../public/images/lary-avatar.svg';
$laryLetter='../../../public/images/lary-newsletter-icon.svg';
$mailBoxIcon='../../../public/images/mailbox-icon.svg';

require_once __DIR__ . '/../../../app/includes/DBconnect.php';
require_once __DIR__ . '/../../../app/Models/Category/Category.php';
require_once __DIR__ . '/../../../app/Models/posts/Post.php';
require_once __DIR__ . '/../../../app/Models/users/User.php';
require_once __DIR__ . '/../../../app/Models/Comment/Comment.php';
include_once __DIR__ . '/../components/navbar.php';
include_once __DIR__ . '/../components/header.php';

$conn = (new connection)->DBconnect();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $post = (new \App\Models\posts\Post())->getPost($id);
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
        <?php include_once __DIR__ . '/../../../resources/views/components/specialPostCard.php' ?>

    </article>
    <section class="col-span-8 col-start-4 mr-10 mt-10 space-y-6">

        <?php
        if ($_SESSION) {
            if ($_SESSION['user']['role'] == 'user') {
                include_once __DIR__ . '/../../../resources/views/components/commentForm.php';
            }
            if ($comments) {
                foreach ($comments as $comment) {
                    $author_id = $comment['user_id'];
                    $author = (new User)->getUserById($author_id);
                    include_once __DIR__ . '/../../../resources/views/components/commentLayout.php';
                }
            }
        } else {
            if ($comments) {
                foreach ($comments as $comment) {
                    $author = (new User)->getUserById($comment['user_id']);
                    include_once __DIR__ . '/../../../resources/views/components/commentLayout.php';
                }
            }
        }


        ?>
    </section>
</div>
</body>
<?php include_once __DIR__ . '/../../../resources/views/components/footer.php' ?>
