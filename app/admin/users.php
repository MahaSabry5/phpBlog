<link rel="stylesheet" href="../includes/tableStyle.css">
<?php
$page = "users";
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
                        <a href="editUser.php?edit_id=<?php echo $user['id'] ?>">Edit</a>
                    </td>
                    <td class="edit">
                        <a href="editUser.php?delete-user=<?php echo $user['id'] ?>">Delete</a>
                    </td>
                </tr>

            <?php endforeach;
        } ?>
    </tbody>
</table>
<?php //include('C:\xampp\htdocs\Laravel\phpBlog\resources\footer.php') ?>

