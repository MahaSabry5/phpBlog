<style type="text/css">

    body {
        width: 100%;
        margin: 20px auto;
        font-family: arial;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    table td {
        font-size: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }

    .country_name-cell {
        width: 200px;
    }

    .code-cell {
        /*width:50px;*/
        color: royalblue;
        width: 200px;

    }

    .edit {
        width: 50px;
        color: royalblue;
    }

    .pop96-cell {
        /*text-align: right;*/
        width: max-content;

    }

    th {
        text-align: left;
    }

</style>
<?php
//include("../includes/public_functions.php");
$page = "categories";
require_once("../Models/Category/Category.php");
require_once("../Models/users/User.php");
$categories = (new Category())->getAllCategories();
?>
<table>
    <thead>
    <tr>
        <th class="country_name-cell">Name</th>
        <th class="code-cell">Slug</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($categories) {
        foreach ($categories as $key => $category): ?>
            <tr class="firstRow">
                <td class="country_name-cell"> <?php echo($category["name"]); ?> </td>
                <td class="code-cell"><?php echo($category["slug"]); ?></td>
                <td class="edit">
                    <a href="#">Edit</a>
                </td>
                <td class="edit">
                    <a href="#">Delete</a>
                </td>
            </tr>

        <?php endforeach;
    } ?>
    </tbody>
</table>
<?php //include('C:\xampp\htdocs\Laravel\phpBlog\resources\footer.php') ?>

