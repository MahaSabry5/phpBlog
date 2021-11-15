<link rel="stylesheet" href="../../../../app/includes/tableStyle.css">
<?php
$page = "categories";
require_once __DIR__.'/../../../../app/Models/Category/Category.php';

$categories = (new Category())->all();
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
        foreach ($categories as $key => $category):
            if($key===0){continue;} ?>
            <tr class="firstRow">
                <td class="country_name-cell"> <?php echo($category["name"]); ?> </td>
                <td class="code-cell"><?php echo($category["slug"]); ?></td>
                <td class="edit">
                    <a href="editCategory.php?edit_id=<?php echo $category['id'] ?>">Edit</a>
                </td>
                <td class="edit">
                    <a href="editCategory.php?delete-category=<?php echo $category['id'] ?>">Delete</a>
                </td>
            </tr>

        <?php endforeach;
    } ?>
    </tbody>
</table>

