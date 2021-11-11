<link rel="stylesheet" href="../includes/tableStyle.css">

<?php
$page = "posts";
require_once("../Models/Category/Category.php");
require_once("../Models/users/User.php");
$posts = (new Post)->getAllPosts();
?>
    <table>
        <thead>
        <tr>
            <th class="country_name-cell">Title</th>
            <th class="code-cell">Category</th>
            <th class="pop96-cell"> Author</th>
            <th class="edit"> </th>
            <th class="edit"> </th>
        </tr>
        </thead>
        <tbody>
            <?php if ($posts){
                foreach ($posts as $key => $post):
                    $category_id=$post['category_id'];
                    $user_id=$post['user_id'];
                    $category = (new Category)->getCategoryById($category_id);
                    $user = (new User)->getUserById($user_id);?>
                    <tr class="firstRow">
                        <td class="country_name-cell"> <?php echo ($post["title"]); ?> </td>
                        <td class="code-cell"><?php echo ($category['name']); ?></td>
                        <td class="pop96-cell"><?php echo ($user["name"]); ?> </td>
                        <td class="edit">
                            <a href="editPost.php?edit_id=<?php echo $post['id'] ?>">Edit</a>
                        </td>
                        <td class="edit">
                            <a href="editPost.php?delete-post=<?php echo $post['id'] ?>">Delete</a>
                        </td>
                    </tr>

                <?php endforeach; }?>

        </tbody>
    </table>

