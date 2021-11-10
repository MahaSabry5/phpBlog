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
$page = "users";
require_once("../Models/Category/Category.php");
require_once("../Models/users/User.php");
$users = (new User())->getAllUsers();
?>
<table>
    <thead>
    <tr>
        <th class="country_name-cell">Name</th>
        <th class="code-cell">username</th>
        <th class="pop96-cell"> email</th>
    </tr>
    </thead>
    <tbody>
        <?php if ($users) {
            foreach ($users as $key => $user): ?>
                <tr class="firstRow">
                    <td class="country_name-cell"> <?php echo($user["name"]); ?> </td>
                    <td class="code-cell"><?php echo($user["username"]); ?></td>
                    <td class="pop96-cell"><?php echo($user["email"]); ?> </td>
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

