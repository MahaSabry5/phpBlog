<?php

use App\Models\Category\Category;

include 'storeCategory.php';
require_once __DIR__.'/../../../../app/Models/Category/Category.php';
$categories = (new Category())->all()?>

<h1 class="text-center text-xl font-bold ">Edit Category</h1>
<form method="POST" action="editCategory.php" class="mt-10">
    <div class="mb-6 ">
        <input class="border border-gray-400 p-2 w-full rounded "
               type="hidden"
               name="id"
               id="id"
               value="<?php echo $category_id; ?>"
        >
    </div>
    <div class="mb-6 ">
        <label for="slug" class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Category
        </label>
        <input class="border border-gray-400 p-2 w-full rounded"
               type="text"
               name="name"
               id="name"
               value="<?php echo $name; ?>"
        >
    </div>
    <div class="mb-6 ">
        <label for="slug" class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Slug
        </label>
        <input class="border border-gray-400 p-2 w-full rounded"
               type="text"
               name="slug"
               id="slug"
               value="<?php echo $slug; ?>"
        >
    </div>

    <div class="mb-6 ">
        <button type="submit" name="edit" class="bg-blue-400 text-white py-2 px-4 rounded hover:bg-blue-500">
            Edit
        </button>
    </div>
    <div class="text-red-500 text-xs mt-1">
        <?php
        include_once __DIR__.'/../../../../app/includes/errors.php';
        ?>
    </div>

</form>