<style type="text/css">

    body {
        width:100%;
        margin:20px auto;
        font-family: arial;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    table td {
        font-size: 12px;
        padding:10px 0;
        border-bottom:1px solid #ddd;
    }

    .country_name-cell {
        width:max-content;
    }

    .code-cell {
        /*width:50px;*/
        color:royalblue;
        width:200px;

    }

    .pop96-cell {
        /*text-align: right;*/
        width:max-content;

    }
    .edit{
        width: 50px;
        color:royalblue;
    }

    th {
        text-align: left;
    }

</style>
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
                            <a href="editPost.php?id=<?php echo $post['id'] ?>">Edit</a>
                        </td>
                        <td class="edit">
                            <a href="#">Delete</a>
<!--                            <form method="POST" action="#">-->
<!--                                @csrf-->
<!--                                @method('DELETE')-->
<!--                                <button class="text-xs mt-3 text-gray-500">-->
<!--                                    Delete-->
<!--                                </button>-->
<!--                            </form>-->
                        </td>
                    </tr>

                <?php endforeach; }?>

        </tbody>
    </table>

