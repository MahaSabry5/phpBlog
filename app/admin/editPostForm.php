<?php

use App\Models\Category\Category;

include 'storePost.php';
require_once("../Models/Category/Category.php");
require_once("../Models/posts/Post.php");
$categories = (new Category())->all();
?>
<h1 class="text-center text-xl font-bold ">Edit Post</h1>
<form method="POST" action="editPost.php" class="mt-10">
    <div class="mb-6 ">
        <input class="border border-gray-400 p-2 w-full rounded "
               type="hidden"
               name="id"
               id="id"
               value="<?php echo $post_id; ?>"
        >
    </div>
    <div class="mb-6 ">
        <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
            TITLE
        </label>
        <input class="border border-gray-400 p-2 w-full rounded"
               type="text"
               name="title"
               id="title"
               value="<?php echo $title; ?>"
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
        <label for="excerpt" class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Excerpt
        </label>
        <input class="border border-gray-400 p-2 w-full rounded"
               type="text"
               name="excerpt"
               id="excerpt"
               value="<?php echo $excerpt ; ?>"
        >

    </div>

    <div class="mb-6 ">
        <label for="body" class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Body
        </label>
        <input class="border border-gray-400 p-2 w-full rounded"
               type="text"
               name="body"
               id="body"
               value="<?php echo $body; ?>"
        >
    </div>
    <div class="mb-6 ">
        <label for="category_id" class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Category
        </label>
        <?php $cat = (new Category)->getCategoryById($category_id); ?>
        <select class="border border-gray-400 p-2 w-full rounded" name="category_id" id="category_id" >
            <option value="<?php echo $cat['id']?>"
            ><?php echo $cat['name']?></option>
            <?php foreach($categories as $category):
                if($cat['id'] === $category['id']){continue;}?>
                <option value="<?php echo $category['id']?>"
                ><?php echo $category['name']?></option>
            <?php endforeach ?>
        </select>

    </div>
    <div class="mb-6 ">
        <button type="submit" name="edit" class="bg-blue-400 text-white py-2 px-4 rounded hover:bg-blue-500">
                Edit
        </button>
    </div>
    <div class="text-red-500 text-xs mt-1">
        <?php include '../includes/errors.php'?>
    </div>

</form>